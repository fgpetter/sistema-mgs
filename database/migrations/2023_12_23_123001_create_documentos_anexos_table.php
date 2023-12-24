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
        Schema::create('documentos_anexos', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->foreignId('funcionario_id');
            $table->string('caminho');
            $table->text('oservacoes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_anexos');
    }
};
