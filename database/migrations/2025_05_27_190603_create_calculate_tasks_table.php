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
        Schema::create('calculate_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_task_id')->constrained('project_tasks')->onDelete('cascade');
            $table->foreignId('type_task_id')->constrained('type_tasks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onUpdate('cascade')->onDelete('cascade');
            $table->string('quantity_unit')->nullable();
            $table->string('total'); // total de material segun la formula de ese material
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculate_tasks');
    }
};
