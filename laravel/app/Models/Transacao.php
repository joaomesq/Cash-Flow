<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = 'transacoes';
    protected $fillable = [
        'descricao', 'categoria', 'valor',
        'tipo', 'usuario_id', 'data'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
