<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noivo extends Model
{
    protected $table = 'noivos';

    protected $fillable = [
        'nome', 'telefone', 'email', 'endereco', 'status', 'observacoesnoivo',
        'datadoevento', 'localevento', 'datadalocacao', 'datadasegundaprova',
        'datadaretirada', 'observacoesevento', 'paleto', 'calca', 'camisa', 'colete',
        'manga', 'barra_calca', 'modelo', 'cor', 'observacoesmedidas',
    ];
    
    

    protected $casts = [
        'datadoevento' => 'date',
        'datadalocacao' => 'date',
        'datadasegundaprova' => 'date',
        'datadaretirada' => 'date',

    ];

    // Relacionamento com os Padrinhos
    public function padrinhos()
    {
        return $this->hasMany(Padrinho::class, 'noivo_id');
    }

    // Relacionamento com o Pedido
    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'noivo_id');
    }

    // Relacionamento com o Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
