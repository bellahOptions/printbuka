<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_evaluations', function (Blueprint $table) {
            $table->id();

            // Section 1 - Personal Information
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('department');
            $table->string('tenure');

            // Section 2 - Self-Performance Ratings (1-5)
            $table->tinyInteger('rating_quality')->nullable();
            $table->tinyInteger('rating_timeliness')->nullable();
            $table->tinyInteger('rating_communication')->nullable();
            $table->tinyInteger('rating_initiative')->nullable();
            $table->tinyInteger('rating_tools_knowledge')->nullable();
            $table->tinyInteger('rating_attitude')->nullable();
            $table->tinyInteger('rating_client_satisfaction')->nullable();

            // Section 3 - Workflow & Operational Understanding
            $table->text('daily_responsibilities');
            $table->text('workflow_process')->nullable();
            $table->json('task_tracking_methods')->nullable(); // checkboxes
            $table->string('deadline_miss_frequency')->nullable();

            // Section 4 - Accountability
            $table->string('underperformance_reason')->nullable();
            $table->string('made_error')->nullable();
            $table->text('error_description')->nullable();
            $table->text('team_issues')->nullable();

            // Section 5 - Growth & Commitment
            $table->text('skills_growth');
            $table->tinyInteger('commitment_level')->nullable();
            $table->string('future_plans')->nullable();
            $table->text('motivation_factors');

            // Section 6 - Operational Feedback
            $table->string('improvement_area')->nullable();
            $table->text('one_change')->nullable();
            $table->text('open_feedback')->nullable();

            // Section 7 - Compensation
            $table->string('current_salary')->nullable();
            $table->string('salary_satisfaction')->nullable();
            $table->string('salary_impact')->nullable();
            $table->json('financial_pressures')->nullable(); // checkboxes
            $table->string('expected_salary')->nullable();
            $table->text('salary_justification')->nullable();
            $table->json('desired_benefits')->nullable(); // checkboxes

            $table->boolean('declaration_agreed')->default(false);
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_evaluations');
    }
};
