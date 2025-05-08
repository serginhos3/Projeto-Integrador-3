<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'noivo_id',
        'padrinho_id', // opcional
        'descricao_itens',
        'valor_itens',
        'valor_total_itens',
        'valor_total_pago',
        'valor_restante',
        'status',
        'datadalocacao',
        'datadasegundaprova',
        'datadaretirada',
        'datadoevento',
        'status_pagamento',
        'observacoes',
    ];

    // Relacionamento com o Noivo
    public function noivo()
    {
        return $this->belongsTo(Noivo::class, 'noivo_id');
    }

    // Relacionamento com Padrinhos (pedido pode ter vários padrinhos)
    public function padrinhos()
    {
        return $this->belongsToMany(Padrinho::class, 'pedido_padrinho', 'pedido_id', 'padrinho_id');
    }
}
