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
        Schema::create('epis', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->unsignedBigInteger('epi_id');
            $table->foreign('epi_id')->references('id')->on('cadastro_epis');
            $table->foreignId('funcionario_id');
            $table->integer('quantidade');
            $table->date('data_entrega');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epis');
    }
};
