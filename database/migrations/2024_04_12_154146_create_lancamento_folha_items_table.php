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
        Schema::create('lancamentos_folha_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lancamento_folha_id');
            $table->foreignId('funcionario_id');
            $table->foreignId('item_id')->nullable();
            $table->string('item_descricao')->nullable();
            $table->string('competencia', 7);
            $table->integer('quantidade');
            $table->decimal('valor_unitario', 8, 2)->nullable();
            $table->decimal('valor_total', 8, 2)->nullable();
            $table->decimal('valor_empresa', 8, 2)->nullable();
            $table->decimal('valor_desconto', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos_folha_itens');
    }
};
