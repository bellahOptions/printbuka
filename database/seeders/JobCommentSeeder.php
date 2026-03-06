<?php
// database/seeders/JobCommentSeeder.php
namespace Database\Seeders;

use App\Models\JobComment;
use App\Models\Admin;
use App\Models\Job;
use Illuminate\Database\Seeder;

class JobCommentSeeder extends Seeder
{
    public function run(): void
    {
        $admins = Admin::all();
        $jobs = Job::all();
        
        if ($jobs->isEmpty()) {
            $this->command->info('No jobs found. Skipping job comments seeder.');
            return;
        }

        $phases = ['Intake', 'Design', 'Production', 'QC', 'Delivery', 'Review', 'General'];
        $comments = [
            'Intake' => [
                'Client requested rush processing for this order.',
                'Special material requirements noted in job specifications.',
                'Customer called to confirm dimensions before proceeding.',
                'Initial consultation completed, client approved design concepts.',
                'Additional measurements needed before production can begin.',
            ],
            'Design' => [
                'Design approved by client after minor revisions.',
                'Working on 3D renderings for client review.',
                'Color scheme finalized and approved.',
                'Font selection needs client confirmation.',
                'Design files prepared for production team.',
            ],
            'Production' => [
                'Production started on schedule.',
                'Quality check passed at mid-production stage.',
                'Material shortage resolved, production continuing.',
                'Machine maintenance caused slight delay.',
                'First batch completed and sent to QC.',
            ],
            'QC' => [
                'All items passed quality inspection.',
                'Minor defects found, sent back for rework.',
                'Sample approved, proceeding with full production.',
                'Final inspection completed successfully.',
                'QC documentation prepared for delivery.',
            ],
            'Delivery' => [
                'Items packaged and ready for pickup.',
                'Delivery scheduled with client for tomorrow.',
                'Client confirmed receipt of all items.',
                'Shipping tracking number sent to customer.',
                'Installation team dispatched to location.',
            ],
            'Review' => [
                'Client very satisfied with final product.',
                'Follow-up call scheduled for next week.',
                'Customer requested quote for additional items.',
                'Positive feedback received from client.',
                'Project successfully completed and closed.',
            ],
            'General' => [
                'Client called with questions about timeline.',
                'Updated job status in system.',
                'Team meeting held to discuss project progress.',
                'Budget review completed, on track.',
                'Supplier contacted about material availability.',
            ],
        ];

        $jobComments = [];
        
        foreach ($jobs as $job) {
            // Add 3-5 comments per job
            $numComments = rand(3, 5);
            
            for ($i = 0; $i < $numComments; $i++) {
                $phase = $phases[array_rand($phases)];
                $admin = $admins->random();
                $isApproved = (rand(1, 10) > 3); // 70% chance of approval
                $approvedBy = $isApproved ? $admins->where('admin_status', 'manager')->random() : null;
                
                $jobComments[] = [
                    'job_id' => $job->id,
                    'admin_id' => $admin->id,
                    'phase' => $phase,
                    'comment' => $comments[$phase][array_rand($comments[$phase])],
                    'is_approved_by_manager' => $isApproved,
                    'approved_by' => $approvedBy?->id,
                    'approved_at' => $isApproved ? now()->subDays(rand(1, 10)) : null,
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30)),
                ];
            }
        }

        foreach ($jobComments as $comment) {
            JobComment::create($comment);
        }
    }
}