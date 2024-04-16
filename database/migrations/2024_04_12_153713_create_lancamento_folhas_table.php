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
        Schema::create('lancamentos_folha', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('competencia', 7)->unique();
            $table->enum('status', ['ABERTO', 'FECHADO']);
            $table->integer('dias_uteis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos_folha');
    }
};
