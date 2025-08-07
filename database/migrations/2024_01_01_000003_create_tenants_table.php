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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Full name of the tenant');
            $table->string('email')->unique()->comment('Tenant email address');
            $table->string('phone')->nullable()->comment('Phone number');
            $table->text('address')->nullable()->comment('Physical address');
            $table->text('notes')->nullable()->comment('Additional notes about tenant');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Tenant status');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('name');
            $table->index('email');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};