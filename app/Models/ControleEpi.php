<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ControleEpi extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'controle_epis';

    /**
     * Retorna o nome do proprietário do epi
     * @return BelongsTo
     */
    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(Funcionario::class);
    }

    /**
     * Retorna o epi
     * @return BelongsTo
     */
    public function epi(): BelongsTo
    {
        return $this->belongsTo(CadastroEpi::class , 'epi_id');
    }


}
