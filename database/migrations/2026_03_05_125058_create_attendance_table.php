<?php
// database/migrations/2024_01_01_000004_create_attendance_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('admin_id')->constrained();
            $table->time('scheduled_in')->nullable();
            $table->time('actual_arrival')->nullable();
            $table->time('actual_departure')->nullable();
            $table->decimal('hours_worked', 4, 2)->nullable();
            
            $table->enum('attendance_status', [
                '✅ Present',
                '🕐 Late (< 30 min)',
                '⏰ Late (> 30 min)',
                '❌ Absent — No Notice',
                '🏥 Sick Leave',
                '📋 Approved Leave'
            ])->nullable();
            
            $table->integer('late_minutes')->nullable();
            $table->text('absence_reason')->nullable();
            $table->decimal('overtime_hours', 4, 2)->nullable();
            $table->foreignId('logged_by')->constrained('admins');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};