<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = ['noivo_id', 'idnoivo', 'noivo', 'valor', 'procedimento', 'dentista', 'status', 'data'];

    protected $casts = [
        'data' => 'date',
    ];

    public function noivo()
    {
        return $this->belongsTo(Noivo::class, 'noivo_id');
    }
}
