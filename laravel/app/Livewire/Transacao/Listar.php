<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;

    public $descricao, $categoria;
    public $valor, $tipo;
    public $dataFim, $dataInicio;

    public $tipos = [
        'receita'=> 'Entrada', 'despesa'=> 'Saída',
    ];

    public function updateDescricao(){
        $this->resetPage();
    }

    public function updateValor(){
        $this->resetPage();
    }

    public function updateTipo(){
        $this->resetPage();
    }

    public function updateDataInicio(){
        $this->resetPage();
    }

    public function updateDataFim(){
        $this->resetPage();
    }

    public function updateCategoria(){
        $this->resetPage();
    }
    
    public function limparFiltros(){
        $this->dataFim = '';
        $this->dataInicio = '';
        $this->descricao = '';
        $this->valor = '';
        $this->categoria = '';
        $this->tipo = '';

        $this->resetPage();
    }

    public function render()
    {
        $transacoes = (new TransacaoService(userId: Auth::user()->id))
                        ->buscar(descricao: $this->descricao, tipo: $this->tipo, categoria: $this->categoria, valor: floatval($this->valor), dataInicio: $this->dataInicio, dataFim: $this->dataFim);
        return view('livewire.transacao.listar', compact('transacoes'));
    }
}
