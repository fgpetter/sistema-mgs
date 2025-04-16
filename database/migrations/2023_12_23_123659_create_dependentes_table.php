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
        Schema::create('dependentes', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->foreignId('funcionario_id');
            $table->string('nome');
            $table->date('nascimento');
            $table->string('parentesco');
            $table->enum('sexo', ['MASCULINO', 'FEMININO', 'OUTRO']);
            $table->enum('est_civil', ['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']);
            $table->string('cartorio')->nullable();
            $table->string('num_registro')->nullable();
            $table->string('livro')->nullable();
            $table->string('folha')->nullable();
            $table->string('nome_pensao')->nullable();
            $table->string('cpf_pensao')->nullable();
            $table->string('banco_pensao')->nullable();
            $table->string('agencia_pensao')->nullable();
            $table->string('conta_pensao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependentes');
    }
};
