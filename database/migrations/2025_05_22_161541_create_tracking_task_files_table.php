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
        Schema::create('tracking_task_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracking_task_id')->constrained('tracking_tasks')->onDelete('cascade');
            $table->string('url_file');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_task_files');
    }
};
