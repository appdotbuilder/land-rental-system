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
        Schema::create('expense_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_id')->nullable()->constrained()->nullOnDelete();
            $table->string('description')->comment('Expense description');
            $table->decimal('amount', 12, 2)->comment('Expense amount');
            $table->date('date')->comment('Date of expense');
            $table->string('category')->default('maintenance')->comment('Expense category');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('land_id');
            $table->index('date');
            $table->index('category');
            $table->index(['category', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_records');
    }
};