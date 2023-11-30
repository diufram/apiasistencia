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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->float('latitud');
            $table->float('longitud');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('taller_id')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('cobro_id')->nullable();
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->boolean('sw')->default(false);
            $table->float('total')->nullable();
            
            $table->foreign('taller_id')->references('id')->on('tallers')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cobro_id')->references('id')->on('cobros')->onDelete('cascade');
            //$table->foreign('servicio_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
