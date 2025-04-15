<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'nome', // Outros campos do evento
    ];

    // Relacionamento com os Noivos
    public function noivos()
    {
        return $this->hasMany(Noivo::class, 'evento_id'); // 'evento_id' é a chave estrangeira na tabela 'noivos'
    }
}
