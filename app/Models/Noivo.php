<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Noivo extends Model
{
    use HasFactory;
    
    protected $table = 'noivos';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco',
        'status',
        'observacoesnoivo',
        'datadoevento',
        'localevento',
        'enderecoevento',
        'datadalocacao',
        'datadasegundaprova',
        'datadaretirada',
        'observacoesevento',
        'paleto',
        'calca',
        'camisa',
        'colete',
        'manga',
        'barra_calca',
        'modelo',
        'cor',
        'observacoesmedidas',
    ];



    protected $casts = [
        'datadoevento' => 'date',
        'datadalocacao' => 'date',
        'datadasegundaprova' => 'date',
        'datadaretirada' => 'date',

    ];

 
    public function padrinhos()
    {
        return $this->hasMany(Padrinho::class, 'noivo_id');
    }


    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'noivo_id');
    }

   
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
