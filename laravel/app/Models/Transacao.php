<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $fillable = [
        'descricao', 'categoria', 'valor',
        'tipo', 'usuario_id', 'data'
    ];

}
