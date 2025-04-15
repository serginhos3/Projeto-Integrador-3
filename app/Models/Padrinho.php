<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padrinho extends Model
{
    use HasFactory;

    protected $table = 'padrinhos';

    protected $fillable = [
        'noivo_id',
        'nome',
        'email',
        'telefone',
        'status',
        'datadelocacao',
        'dataderetirada',
        'paleto',
        'calca',
        'camisa',
        'colete',
        'manga',
        'barra_calca',
        'modelo_terno',
        'cor_terno',
        'observacoes',
    ];

    protected $casts = [
        'datadelocacao' => 'date',
        'dataderetirada' => 'date',
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
