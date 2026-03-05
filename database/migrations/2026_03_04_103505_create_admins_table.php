<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('password');
            $table->rememberToken();

            // admin_status: only 'super_admin' can mark others active
            $table->enum('admin_status', ['super_admin', 'staff', 'manager'])->default('staff');

            // is_active: false by default — SuperAdmin must activate
            $table->boolean('is_active')->default(false);

            $table->enum('staff_role', [
                'HR', 'IT', 'Operations', 'customer_service',
                'Designer', 'Operator', 'Operations Manager', 'QC','Finance', 'other',
            ])->default('Operations');
            $table->string('other_role')->nullable(); // populated if staff_role = 'other'

            $table->date('date_of_birth');

            // Stored as a filename only — full path resolved via Storage facade
            $table->string('photo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
