<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Funcionario extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Retorna os dados bancarios do funcionário.
     */
    public function dadosBancarios(): HasMany
    {
        return $this->hasMany(DadoBancario::class);
    }

    /**
     * Retorna o ponto do funcionário.
     */
    public function lancamentosPonto(): HasMany
    {
        return $this->hasMany(LancamentoPonto::class);
    }


}
