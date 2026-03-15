<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ResumoReceita extends Component
{
    use WithPagination;    

    public $total = 0;
    public $filtro = "categoria";
    
    public function render()
    {   
        $receitas = $this->setReceitas(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.transacao.resumo-receita', compact('receitas'));
    }

    public function setReceitas(TransacaoService $transacaoService){
        return $transacaoService->resumoTransacoes(tipo: 'receita', limite: 5, coluna: strtolower($this->filtro), periodo: 'todo');
    }

    public function alterarFiltro(string $filtro = "categoria"){
        $this->filtro = $filtro;
    }
    
    private function calcularTotal(array $receitas){
        foreach ($receitas as $receita) {
            $this->total += $receita->total;
        }
    }
}
