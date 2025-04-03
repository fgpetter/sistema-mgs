<?php

use App\Models\Obra;
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
      $table->enum('raca_cor', ['BRANCA', 'PRETA', 'PARDA', 'AMARELA', 'INDIGENA', 'OUTRO']);
      $table->enum('sexo', ['MASCULINO', 'FEMININO', 'OUTRO']);
      $table->enum('est_civil', ['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']);
      $table->string('nacionalidade')->default('Brasileiro');
      $table->char('naturalidade_uf', 2)->nullable();
      $table->string('naturalidade')->nullable();
      $table->date('nascimento')->nullable();
      $table->string('nome_mae')->nullable();
      $table->string('nome_pai')->nullable();
      $table->string('nome_conjuge')->nullable();
      $table->string('tipo_sanguineo')->nullable();
      $table->boolean('pcd')->default('0');
      $table->string('cpf')->nullable();
      $table->string('cert_reserv')->nullable();
      $table->string('rg')->nullable();
      $table->date('emissao_rg')->nullable();
      $table->string('emissor_rg')->nullable();
      $table->string('ctps')->nullable();
      $table->date('ctps_emissao')->nullable();
      $table->string('ctps_serie')->nullable();
      $table->char('ctps_uf')->nullable();
      $table->string('e_social')->nullable();
      $table->string('cnh')->nullable();
      $table->date('cnh_val')->nullable();
      $table->date('cnh_registro')->nullable();
      $table->char('cnh_categ', 2)->nullable();
      $table->string('titulo_eleitor')->nullable();
      $table->string('titulo_eleitor_cidade')->nullable();
      $table->string('titulo_eleitor_zona')->nullable();
      $table->string('titulo_eleitor_cecao')->nullable();
      $table->string('pis')->nullable();
      $table->date('data_opcao_fgts')->nullable();
      $table->string('conta_fgts')->nullable();
      $table->string('cbo')->nullable();
      $table->string('cbo_desc')->nullable();
      $table->string('endereco')->nullable();
      $table->string('complemento')->nullable();
      $table->string('bairro')->nullable();
      $table->string('cidade')->nullable();
      $table->char('uf', 2)->nullable();
      $table->string('cep')->nullable();
      $table->string('telefone')->nullable();
      $table->string('telefone_2')->nullable();
      $table->string('email')->nullable();
      $table->string('cargo')->nullable();
      $table->string('funcao')->nullable();
      $table->string('escolaridade')->nullable();
      $table->string('local_trabalho')->nullable();
      $table->foreignIdFor(Obra::class)->nullable();
      $table->date('admissao')->nullable();
      $table->date('demissao')->nullable();
      $table->double('salario', 8, 2)->nullable();
      $table->double('insalubridade', 8, 2)->nullable();
      $table->double('assiduidade', 8, 2)->nullable();
      $table->boolean('vale_transporte')->nullable();
      $table->boolean('contribuicao')->nullable();
      $table->time('hr_entrada')->nullable();
      $table->string('situacao')->default('ativo');
      $table->text('observacoes')->nullable();
      $table->string('matricula')->nullable();
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
