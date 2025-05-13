<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'nome', 
    ];

    
    public function noivos()
    {
        return $this->hasMany(Noivo::class, 'evento_id'); 
    }
}
