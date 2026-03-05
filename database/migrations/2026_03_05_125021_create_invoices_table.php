<?php
// database/migrations/2024_01_01_000003_create_invoices_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('job_id')->constrained();
            $table->date('date_issued');
            $table->date('payment_due_by');
            
            // Client snapshot
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email')->nullable();
            $table->text('client_address')->nullable();
            
            // Items (JSON for flexibility)
            $table->json('items'); // [{description, size, material, qty, unit_price, discount, amount}]
            
            $table->decimal('subtotal', 15, 2);
            $table->decimal('vat', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('total_due', 15, 2);
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('balance', 15, 2);
            
            $table->enum('payment_status', ['Unpaid', 'Partial', 'Paid'])->default('Unpaid');
            $table->string('payment_method')->nullable();
            $table->date('payment_date')->nullable();
            
            $table->foreignId('created_by')->constrained('admins');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};