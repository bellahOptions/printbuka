<?php
// database/migrations/2024_01_01_000002_create_job_comments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained();
            $table->enum('phase', [
                'Intake', 'Design', 'Production', 'QC', 'Delivery', 'Review', 'General'
            ])->default('General');
            $table->text('comment');
            $table->boolean('is_approved_by_manager')->default(false);
            $table->foreignId('approved_by')->nullable()->constrained('admins');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_comments');
    }
};