<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterTransacao extends Component
{
    public $valor;
    public $tipo;
    public $descricao;
    public $categoria;
    public $data;
    private $transacaoService;

    public function mount(){
        $this->transacaoService = new TransacaoService(userId: Auth::user()->id);
        $this->valor = 0.00;
    }

    public function render()
    {
        return view('livewire.transacao.register-transacao');
    }

    public function salvar(){
        if($this->valor <= 0):
            return;
        endif;

        $this->transacaoService->inserir(valor: $this->valor, tipo: $this->tipo, categoria: $this->categoria, descricao: $this->descricao, data: $this->data);
        $this->reset(['valor', 'descricao', 'tipo', 'categoria', 'data']);
    }
}
