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
        Schema::create('task_construct_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_construct_id')->constrained('task_constructs')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->string('quantity'); // cantidad de material
            $table->string('valor'); // Peso o tamaño segun la unidad de medida
            $table->string('unit'); // unidad de medida
            $table->string('formula'); // formula de calculo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_construct_materials');
    }
};
