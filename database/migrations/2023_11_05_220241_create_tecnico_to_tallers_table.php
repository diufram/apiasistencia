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
        Schema::create('tecnico_to_tallers', function (Blueprint $table) {
            $table->unsignedBigInteger('taller_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->foreign('taller_id')->references('id')->on('tallers')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnico_to_tallers');
    }
};
