<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $descricao;
    public $categori;
    public $valor;
    public $tipo;
    public $data;

    public function UpdateDescricao(){
        $this->resetPage();
    }
    
    public function render()
    {
        $this->descricao = 'pass';
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->buscar(descricao: $this->descricao);
        return view('livewire.transacao.listar', compact('transacoes'));
    }
}
