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
        Schema::create('controle_epis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epi_id');
            $table->foreignId('funcionario_id');
            $table->integer('quantidade')->default(1);
            $table->string('tamanho')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_epis');
    }
};
