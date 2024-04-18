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
        Schema::create('pontos_consolidados', function (Blueprint $table) {
            $table->id();
            $table->string('competencia');
            $table->foreignId('funcionario_id');
            $table->decimal('he_50', 8, 2)->default(0.00);
            $table->decimal('he_100', 8, 2)->default(0.00);
            $table->decimal('faltas', 8, 2)->default(0.00);
            $table->integer('dias_trabalhados')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pontos_consolidados');
    }
};
