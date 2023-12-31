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
        Schema::create('cadastro_beneficios', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('nome')->nullable();
            $table->string('descricao')->nullable();
            $table->boolean('mostrar_folha')->nullable();
            $table->boolean('desconto')->nullable();
            $table->string('codigo')->nullable();
            $table->string('empresa')->nullable();
            $table->string('evento_folha')->nullable();
            $table->string('tipo_evento')->nullable();
            $table->boolean('permite_lancamento')->nullable();
            $table->string('tipo_beneficio')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadastro_beneficios');
    }
};
