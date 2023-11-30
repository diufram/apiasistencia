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
        Schema::create('servicio_to_tallers', function (Blueprint $table) {
            $table->unsignedBigInteger('taller_id');
            $table->unsignedBigInteger('servicio_id');
            $table->primary(['taller_id','servicio_id']);
            $table->double('precio');
            $table->foreign('taller_id')->references('id')->on('tallers')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_to_tallers');
    }
};
