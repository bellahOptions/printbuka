<?php
// app/Http/Controllers/Admin/JobController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobComment;
use App\Models\SopChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->user();
        $query = Job::query();

        // Role-based filtering
        if (!$admin->isSuperAdmin() && $admin->staff_role !== 'Operations Manager') {
            switch($admin->staff_role) {
                case 'Designer':
                    $query->where('assigned_designer', $admin->full_name);
                    break;
                case 'Operations':
                    $query->where('production_officer', $admin->full_name)
                        ->orWhereNull('production_officer');
                    break;
                case 'QC':
                    $query->where('job_status', 'Quality Check & Packaging');
                    break;
                case 'customer_service':
                    // Can see all but not financials
                    break;
                case 'Finance':
                    // Can see all including financials
                    break;
            }
        }

        // Apply filters
        if ($request->status) {
            $query->where('job_status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('job_order', 'like', "%{$request->search}%")
                  ->orWhere('client_name', 'like', "%{$request->search}%")
                  ->orWhere('client_phone', 'like', "%{$request->search}%");
            });
        }

        $jobs = $query->with('creator')->latest()->paginate(20);
        
        // Hide financial data for non-finance roles
        if (!$admin->canAccessFinancials()) {
            $jobs->each(function($job) {
                $job->makeHidden(['invoice_amount', 'amount_paid']);
            });
        }

        return view('admin.jobs.index', [
            'jobs' => $jobs,
            'admin' => $admin,
            'statuses' => $this->getStatuses(),
            'priorities' => ['🔴 Urgent', '🟡 Normal', '🟢 Low'],
        ]);
    }

    public function create()
    {
        $admin = auth()->user();
        
        if (!$admin->canManageJobs()) {
            abort(403, 'Unauthorized to create jobs');
        }

        return view('admin.jobs.create', [
            'admin' => $admin,
            'jobTypes' => $this->getSettings('job_types'),
            'materials' => $this->getSettings('materials'),
            'finishes' => $this->getSettings('finishes'),
        ]);
    }

    public function store(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin->canManageJobs()) {
            abort(403);
        }

        $validated = $request->validate([
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'client_email' => 'nullable|email',
            'client_address' => 'nullable|string',
            'job_type' => 'required|string',
            'size_format' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'material' => 'nullable|string',
            'finish' => 'nullable|string',
            'brief_date' => 'required|date',
            'priority' => 'required|in:🔴 Urgent,🟡 Normal,🟢 Low',
        ]);

        DB::transaction(function() use ($validated, $admin) {
            // Generate job order number
            $year = date('Y');
            $lastJob = Job::whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();
            
            $sequence = $lastJob ? intval(substr($lastJob->job_order, -4)) + 1 : 1;
            $jobOrder = sprintf('PB-%s-%04d', $year, $sequence);

            $job = Job::create([
                'job_order' => $jobOrder,
                'date_logged' => now(),
                ...$validated,
                'brief_received_by' => $admin->full_name,
                'job_status' => 'Analyzing Job Brief',
                'payment_status' => 'Awaiting Invoice',
                'client_review_status' => 'Pending Client Feedback',
                'created_by' => $admin->id,
            ]);

            // Create SOP checklist items
            $this->createSopChecklist($job);
        });

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job created successfully');
    }

    public function show(Job $job)
    {
        $admin = auth()->user();
        
        if (!$admin->canViewCustomerData() && $job->assigned_designer !== $admin->full_name) {
            abort(403);
        }

        $job->load(['comments' => function($q) {
            $q->with('admin')->latest();
        }, 'sopChecklist']);

        return view('admin.jobs.show', [
            'job' => $job,
            'admin' => $admin,
            'canViewFinancials' => $admin->canAccessFinancials(),
            'canEdit' => $job->canUserEdit($admin),
            'canApprove' => $admin->canApproveJobPhase(),
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $admin = auth()->user();
        
        if (!$job->canUserEdit($admin)) {
            abort(403);
        }

        $rules = [
            'job_status' => 'sometimes|in:' . implode(',', $this->getStatuses()),
        ];

        // Role-specific validation
        switch($admin->staff_role) {
            case 'Designer':
                $rules['design_file_path'] = 'nullable|file|mimes:pdf,ai,psd,eps|max:10240';
                $rules['design_approved_by_client'] = 'boolean';
                break;
            case 'QC':
                $rules['qc_result'] = 'required|in:✅ Passed,❌ Failed - Reprint,⚠️ Minor Issues';
                $rules['qc_notes'] = 'nullable|string';
                break;
            case 'customer_service':
                $rules['actual_delivery_date'] = 'nullable|date';
                $rules['client_review_status'] = 'nullable|string';
                break;
            case 'Finance':
                $rules['invoice_amount'] = 'nullable|numeric|min:0';
                $rules['amount_paid'] = 'nullable|numeric|min:0';
                $rules['payment_status'] = 'nullable|string';
                break;
        }

        $validated = $request->validate($rules);

        DB::transaction(function() use ($validated, $job, $admin, $request) {
            // Handle file upload for designer
            if ($request->hasFile('design_file')) {
                $path = $request->file('design_file')->store('designs', 'public');
                $validated['design_file_path'] = $path;
            }

            // Update role-specific fields
            if ($admin->staff_role === 'QC' && isset($validated['qc_result'])) {
                $validated['qc_checked_by'] = $admin->full_name;
                $validated['qc_date'] = now();
            }

            if ($admin->staff_role === 'customer_service' && isset($validated['actual_delivery_date'])) {
                $validated['delivered_by'] = $admin->full_name;
            }

            $job->update($validated);
            $job->updateStatusFromPhase();
        });

        return redirect()->route('admin.jobs.show', $job)
            ->with('success', 'Job updated successfully');
    }

    public function addComment(Request $request, Job $job)
    {
        $admin = auth()->user();
        
        $validated = $request->validate([
            'comment' => 'required|string',
            'phase' => 'required|in:Intake,Design,Production,QC,Delivery,Review,General',
        ]);

        $comment = $job->comments()->create([
            'admin_id' => $admin->id,
            'phase' => $validated['phase'],
            'comment' => $validated['comment'],
            'is_approved_by_manager' => $admin->canApproveJobPhase(),
            'approved_by' => $admin->canApproveJobPhase() ? $admin->id : null,
            'approved_at' => $admin->canApproveJobPhase() ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment->load('admin'),
        ]);
    }

    public function approveComment(JobComment $comment)
    {
        $admin = auth()->user();
        
        if (!$admin->canApproveJobPhase()) {
            abort(403);
        }

        $comment->update([
            'is_approved_by_manager' => true,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    protected function createSopChecklist(Job $job)
    {
        $sopItems = [
            ['phase' => 1, 'step' => '1.0', 'task' => 'Receive client enquiry and acknowledge within 2 hours', 'responsible' => 'Customer Service'],
            ['phase' => 1, 'step' => '2.0', 'task' => 'Collect complete brief: type, size, quantity, deadline, reference files', 'responsible' => 'Customer Service'],
            ['phase' => 1, 'step' => '3.0', 'task' => 'Assign Job Order # and log in Job Tracker', 'responsible' => 'Customer Service'],
            ['phase' => 1, 'step' => '4.0', 'task' => 'Issue quote to client and collect 70% deposit before proceeding', 'responsible' => 'Customer Service'],
            ['phase' => 2, 'step' => '5.0', 'task' => 'Pass approved brief + reference files to assigned Designer', 'responsible' => 'Customer Service'],
            ['phase' => 2, 'step' => '6.0', 'task' => 'Designer confirms receipt of brief. Log Design Start Date.', 'responsible' => 'Designer'],
            ['phase' => 2, 'step' => '7.0', 'task' => 'Prepare print-ready artwork: correct bleed (3mm), resolution (300dpi+)', 'responsible' => 'Designer'],
            ['phase' => 2, 'step' => '8.0', 'task' => 'Send proof to client for approval. Log date sent.', 'responsible' => 'Designer/CS'],
            ['phase' => 2, 'step' => '9.0', 'task' => 'Get documented client approval', 'responsible' => 'Designer/CS'],
            ['phase' => 3, 'step' => '10.0', 'task' => 'Receive approved artwork file from Design', 'responsible' => 'Production'],
            ['phase' => 3, 'step' => '11.0', 'task' => 'Confirm material/substrate is in stock', 'responsible' => 'Production'],
            ['phase' => 3, 'step' => '12.0', 'task' => 'Confirm 70% payment received before starting', 'responsible' => 'Management'],
            ['phase' => 3, 'step' => '13.0', 'task' => 'Complete full production run', 'responsible' => 'Production'],
            ['phase' => 4, 'step' => '14.0', 'task' => 'Inspect ALL units against approved proof', 'responsible' => 'QC Officer'],
            ['phase' => 4, 'step' => '15.0', 'task' => 'Package approved job with label', 'responsible' => 'Production'],
            ['phase' => 5, 'step' => '16.0', 'task' => 'Confirm 100% payment before dispatch', 'responsible' => 'CS/Management'],
            ['phase' => 5, 'step' => '17.0', 'task' => 'Notify client and dispatch job', 'responsible' => 'Customer Service'],
            ['phase' => 6, 'step' => '18.0', 'task' => 'Follow up with client for satisfaction', 'responsible' => 'Customer Service'],
        ];

        foreach ($sopItems as $item) {
            SopChecklist::create([
                'job_id' => $job->id,
                'phase' => $item['phase'],
                'step_number' => $item['step'],
                'task' => $item['task'],
                'responsible' => $item['responsible'],
                'status' => 'Pending',
            ]);
        }
    }

    protected function getStatuses()
    {
        return [
            'Analyzing Job Brief',
            'Design / Artwork Preparation',
            'In Production',
            'Quality Check & Packaging',
            'Delivery In Progress',
            'Delivered',
            'On Hold',
            'Cancelled',
        ];
    }

    protected function getSettings($type)
    {
        // This would normally come from a settings table
        $settings = [
            'job_types' => ['Business Cards', 'Flyers', 'Banners', 'Roll-Up Banner', 'Letterheads', 'Compliment Slips', 'Branding Kit', 'ID Cards', 'Stickers', 'T-Shirt Print', 'Engraving', 'UV DTF', 'DTF prints', 'Jotters', 'Calendar', 'Other'],
            'materials' => ['Art Paper 90gsm', 'Art Paper 115gsm', 'Art Paper 150gsm', 'Art Paper 200gsm', 'Art Card 250gsm', 'Art Card 300gsm', 'Art Card 350gsm', 'Vinyl', 'PVC', 'Fabric', 'Cotton', 'Aluminium', 'Wood', 'Acrylic'],
            'finishes' => ['Gloss Lamination', 'Matt Lamination', 'Spot UV', 'No Finish', 'Embossing', 'Foil Stamping', 'Perforation', 'Spiral Binding', 'Saddle Stitch', 'Perfect Bind'],
        ];

        return $settings[$type] ?? [];
    }
}