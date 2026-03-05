<?php
// database/migrations/2024_01_01_000006_create_sop_checklist_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sop_checklist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained();
            $table->integer('phase'); // 1-6
            $table->string('step_number'); // e.g., "1.0"
            $table->string('task');
            $table->string('responsible');
            $table->enum('status', ['Pending', 'In Progress', 'Done'])->default('Pending');
            $table->foreignId('completed_by')->nullable()->constrained('admins');
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('admins');
            $table->timestamp('verified_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sop_checklist');
    }
};