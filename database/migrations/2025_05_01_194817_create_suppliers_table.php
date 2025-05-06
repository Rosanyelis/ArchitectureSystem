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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cuit_del_proveedor')->unique();
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('provincia')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
