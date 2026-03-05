<?php
// database/migrations/2024_01_01_000005_create_daily_staff_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_staff_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('admin_id')->constrained();
            $table->string('department');
            
            $table->integer('jobs_assigned')->default(0);
            $table->integer('jobs_completed')->default(0);
            $table->integer('jobs_pending')->storedAs('GREATEST(jobs_assigned - jobs_completed, 0)');
            
            $table->integer('errors_reported')->default(0);
            $table->text('error_description')->nullable();
            $table->integer('client_complaints')->default(0);
            
            $table->text('initiative_action')->nullable();
            $table->integer('teamwork_rating')->nullable(); // 1-5
            $table->integer('supervisor_rating')->nullable(); // 1-5
            $table->text('supervisor_notes')->nullable();
            
            $table->foreignId('logged_by')->constrained('admins');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_staff_logs');
    }
};