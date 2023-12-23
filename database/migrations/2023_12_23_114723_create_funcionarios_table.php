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
    Schema::create('funcionarios', function (Blueprint $table) {
      $table->id();
      $table->string('uid');
      $table->string('nome');
      $table->enum('raca_cor', ['BRANCA', 'PRETA', 'PARDA', 'AMARELA', 'INDIGENA', 'OUTRO'])->nullable();
      $table->enum('sexo', ['MASCULINO', 'FEMININO', 'OUTRO']);
      $table->enum('est_civil', ['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']);
      $table->strign('nacionalidade');
      $table->char('naturalidade_uf', 2);
      $table->string('naturalidade');
      $table->date('nascimento');
      $table->string('nome_mae');
      $table->string('nome_pai')->nullable();
      $table->string('nome_conjuge')->nullable();
      $table->string('fator_sanguineo')->nullable();
      $table->boolean('pcd');
      $table->string('cpf');
      $table->string('cert_reserv');
      $table->string('rg');
      $table->date('emissao_rg');
      $table->string('emissor_rg');
      $table->strign('ctps');
      $table->strign('ctps_serie');
      $table->char('ctps_uf');
      $table->string('cnh')->nullable();
      $table->date('cnh_val')->nullable();
      $table->date('cnh_registro')->nullable();
      $table->char('cnh_categ', 2)->nullable();
      $table->string('titulo_eleitor');
      $table->string('titulo_eleitor_zona');
      $table->string('titulo_eleitor_cessao');
      $table->string('pis');
      $table->date('data_opcao_fgts');
      $table->string('conta_fgts');
      $table->string('cbo');
      $table->string('endereco');
      $table->string('complemento')->nullable();
      $table->string('bairro')->nullable();
      $table->string('cidade');
      $table->char('uf', 2);
      $table->string('cep');
      $table->string('telefone');
      $table->string('telefone_2')->nullable();
      $table->string('email')->nullable();
      $table->string('cargo')->nullable();
      $table->string('funcao')->nullable();
      $table->string('escolaridade')->nullable();
      $table->integer('local_trabalho')->nullable();
      $table->foreign('local_trabalho')->references('id')->on('locais_trabalho');
      $table->date('admissao');
      $table->date('demissao')->nullable();
      $table->string('salario')->nullable();
      $table->string('quinquenio')->nullable();
      $table->string('func_gratificada')->nullable();
      $table->integer('periculosidade')->nullable();
      $table->integer('prestador_servico')->nullable();
      $table->boolean('vale_transporte');
      $table->boolean('contribuicao');
      $table->string('situacao')->default('ativo');
      $table->text('observacoes')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
  }
};
