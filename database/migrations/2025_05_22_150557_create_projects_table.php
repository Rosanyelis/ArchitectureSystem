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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_id')->constrained('budgets')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('contractor_id')->nullable()->constrained('contractors')->onDelete('cascade');
            $table->string('name'); // nombre del proyecto
            $table->string('url_image'); // url de la imagen del proyecto
            $table->string('description'); // descripcion del proyecto
            $table->date('start_date')->nullable(); // fecha de inicio del proyecto
            $table->date('end_date')->nullable(); // fecha de fin del proyecto
            $table->string('address'); // direccion del proyecto
            $table->string('location'); // ubicacion del proyecto
            $table->string('province'); // latitud del proyecto
            $table->enum('status', ['Pendiente', 'En progreso', 'Completado'])->default('Pendiente' ); // estado del proyecto
            $table->enum('status_permission', ['Pendiente', 'Aprobado', 'Rechazado'])->default('Pendiente'); // estado de aprobacion del proyecto
            $table->enum('status_payment', ['Pendiente', 'Pagado', 'Cancelado'])->default('Pendiente'); // estado de pago del proyecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
