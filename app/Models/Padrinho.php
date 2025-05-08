<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padrinho extends Model
{
    use HasFactory;

    protected $table = 'padrinhos';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'status',
        'observacoes',

        'noivo_id',
        'datadalocacao',
        'datadaretirada',
        'observacoesevento',

        'paleto',
        'calca',
        'camisa',
        'colete',
        'manga',
        'barra_calca',
        'modelo_terno',
        'cor_terno',
        'observacoes_medidas',
    ];

    protected $casts = [
        'datadalocacao' => 'date',
        'datadaretirada' => 'date',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idpadrinho');
    }

    public function noivo()
    {
        return $this->belongsTo(Noivo::class);
    }
    
}
