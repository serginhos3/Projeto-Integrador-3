<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'noivo_id',
        'padrinho_id',
        'descricao_itens',
        'valor_itens',
        'valor_total_itens',
        'valor_total_pago',
        'valor_restante',
        'status',
        'valor_pagamentos',
        'metodo_pagamento',
        'datadalocacao',
        'datadasegundaprova',
        'datadaretirada',
        'datadoevento',
        'status_pagamento',
        'observacoes',
        'data_pagamento',
    ];

   
    public function noivo()
    {
        return $this->belongsTo(Noivo::class, 'noivo_id');
    }

 
    public function padrinhos()
    {
        return $this->belongsToMany(Padrinho::class, 'pedido_padrinho', 'pedido_id', 'padrinho_id');
    }
}
