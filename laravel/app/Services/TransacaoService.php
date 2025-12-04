<?php
namespace App\Services;

use App\Models\Transacao;

class TransacaoService{
    private $idUser;

    public function __construct(int $userId)
    {
        $this->idUser = $userId;
    }

    public function getAll(){
        return Transacao::where('usuario_id', $this->idUser)->paginate(10);
    }
}