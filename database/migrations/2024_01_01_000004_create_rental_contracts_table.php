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
        Schema::create('rental_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('land_id')->constrained()->cascadeOnDelete();
            $table->date('start_date')->comment('Contract start date');
            $table->date('end_date')->comment('Contract end date');
            $table->integer('duration_years')->comment('Rental duration in years');
            $table->decimal('payment_amount', 12, 2)->comment('Annual rental amount');
            $table->enum('status', ['active', 'expired', 'terminated'])->default('active')->comment('Contract status');
            $table->text('notes')->nullable()->comment('Additional contract notes');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('tenant_id');
            $table->index('land_id');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('status');
            $table->index(['status', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_contracts');
    }
};