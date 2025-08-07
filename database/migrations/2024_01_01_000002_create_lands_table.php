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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Land name or identifier');
            $table->string('location')->comment('Physical location of the land');
            $table->decimal('area', 10, 2)->comment('Area/size in acres or hectares');
            $table->string('area_unit')->default('acres')->comment('Unit of area measurement');
            $table->text('description')->nullable()->comment('Detailed description of the land');
            $table->enum('status', ['available', 'rented'])->default('available')->comment('Current rental status');
            $table->timestamps();
            
            // Add indexes for performance
            $table->index('name');
            $table->index('location');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};