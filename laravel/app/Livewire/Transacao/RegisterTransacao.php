<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterTransacao extends Component
{
    public $valor = 0.00;
    public $tipo;
    public $descricao;
    public $categoria;
    public $data;
    private $transacaoService;

    public function render()
    {
        return view('livewire.transacao.register-transacao');
    }

    public function salvar(){
        (new TransacaoService(userId: Auth::user()->id))->inserir(valor: $this->valor, tipo: $this->tipo, categoria: $this->categoria, descricao: $this->descricao, data: $this->data);
    }
}
