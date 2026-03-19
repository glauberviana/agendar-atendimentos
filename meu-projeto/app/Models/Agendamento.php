<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importe esta classe

class Agendamento extends Model
{
    protected $fillable = [
        'user_id',
        'data',
        'hora',
        'tipo',
        'descricao',
        'status' // Recomendo adicionar o status aqui também para poder editá-lo depois
    ];

    /**
     * Define a relação: Um agendamento pertence a um Usuário.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
