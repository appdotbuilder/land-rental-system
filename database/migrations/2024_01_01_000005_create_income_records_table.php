<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_contract_id')->nullable()->constrained()->nullOnDelete();
            $table->string('description')->comment('Income description');
            $table->decimal('amount', 12, 2)->comment('Income amount');
            $table->date('date')->comment('Date of income');
            $table->enum('payment_status', ['paid', 'pending', 'overdue'])->default('pending')->comment('Payment status');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('rental_contract_id');
            $table->index('date');
            $table->index('payment_status');
            $table->index(['payment_status', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_records');
    }
};