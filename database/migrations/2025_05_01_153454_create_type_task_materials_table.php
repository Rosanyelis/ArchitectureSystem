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
        Schema::create('type_task_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_task_id')->constrained('type_tasks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onUpdate('cascade')->onDelete('cascade');
            $table->string('quantity_unit')->nullable();
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_task_materials');
    }
};
