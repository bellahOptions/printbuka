<?php
// database/migrations/2024_01_01_000001_create_jobs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->string('job_order')->unique(); // PB-YYYY-XXXX
            $table->string('invoice_number')->nullable();
            $table->date('date_logged');
            
            // Client Information
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email')->nullable();
            $table->text('client_address')->nullable();
            
            // Job Specifications
            $table->string('job_type');
            $table->string('size_format');
            $table->integer('quantity');
            $table->string('material')->nullable();
            $table->string('finish')->nullable();
            
            // Phase 1 - Intake
            $table->string('brief_received_by');
            $table->date('brief_date');
            $table->enum('priority', ['🔴 Urgent', '🟡 Normal', '🟢 Low'])->default('🟡 Normal');
            
            // Phase 2 - Design
            $table->string('assigned_designer')->nullable();
            $table->date('design_start_date')->nullable();
            $table->boolean('design_approved_by_client')->default(false);
            $table->date('design_approval_date')->nullable();
            $table->string('design_file_path')->nullable(); // Uploaded design
            
            // Phase 3 - Production
            $table->string('production_officer')->nullable();
            $table->date('production_start_date')->nullable();
            $table->date('production_end_date')->nullable();
            
            // Phase 4 - QC & Packaging
            $table->string('qc_checked_by')->nullable();
            $table->date('qc_date')->nullable();
            $table->enum('qc_result', ['✅ Passed', '❌ Failed - Reprint', '⚠️ Minor Issues'])->nullable();
            $table->text('qc_notes')->nullable();
            
            // Phase 5 - Delivery
            $table->date('estimated_delivery_date')->nullable();
            $table->date('actual_delivery_date')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('delivered_by')->nullable();
            
            // Phase 6 - Client Review
            $table->enum('client_review_status', [
                'Pending Client Feedback',
                'Client Satisfied ✅',
                'Revision Requested 🔄',
                'Reprint Required 🔁',
                'Escalated ⚠️'
            ])->default('Pending Client Feedback');
            $table->text('after_sales_action')->nullable();
            $table->date('after_sales_resolved_date')->nullable();
            
            // Financials (hidden from certain roles)
            $table->decimal('invoice_amount', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->enum('payment_status', [
                'Awaiting Invoice',
                'Invoice Issued',
                'Pending Payment',
                'Invoice Settled (70%)',
                'Invoice Settled (100%)'
            ])->default('Awaiting Invoice');
            
            // Tracking
            $table->enum('job_status', [
                'Analyzing Job Brief',
                'Design / Artwork Preparation',
                'In Production',
                'Quality Check & Packaging',
                'Delivery In Progress',
                'Delivered',
                'On Hold',
                'Cancelled'
            ])->default('Analyzing Job Brief');
            
            $table->text('internal_notes')->nullable();
            $table->foreignId('created_by')->constrained('admins');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};