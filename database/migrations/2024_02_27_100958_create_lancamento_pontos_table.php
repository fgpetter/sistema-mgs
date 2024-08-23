<?php

use App\Models\Obra;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lancamento_ponto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id');
            $table->foreignIdFor(Obra::class, 'obra_id')->nullable();
            $table->string('competencia', 7);
            $table->enum('status', ['ABERTO', 'FECHADO'])->default('ABERTO');
            $table->date('data');
            $table->time('entrada_1')->nullable();
            $table->time('saida_1')->nullable();
            $table->time('entrada_2')->nullable();
            $table->time('saida_2')->nullable();
            $table->time('entrada_3')->nullable();
            $table->time('saida_3')->nullable();
            $table->integer('min_trabalhados')->nullable();
            $table->integer('qtd_min_50')->nullable();
            $table->integer('qtd_min_100')->nullable();
            $table->integer('qtd_min_not')->nullable();
            $table->integer('qtd_min_desc')->nullable();
            $table->enum('anotacao', ['FOLGA', 'ABONADO', 'FERIAS', 'FALTA','FERIADO'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamento_ponto');
    }
};
