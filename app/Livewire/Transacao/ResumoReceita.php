<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResumoReceita extends Component
{
    public $receitas;
    public $total = 0;
    public $filtro = "categoria";
    
    public function render()
    {   
        $this->setReceitas(new TransacaoService(userId: Auth::user()->id));
        $this->calcularTotal();
        return view('livewire.transacao.resumo-receita');
    }

    public function setReceitas(TransacaoService $transacaoService){
        $this->receitas = $transacaoService->resumoTransacoes(tipo: 'receita', coluna: strtolower($this->filtro), periodo: 'todo');
    }

    public function alterarFiltro(string $filtro = "categoria"){
        $this->filtro = $filtro;
    }
    
    private function calcularTotal(){
        foreach ($this->receitas as $receita) {
            $this->total += $receita->total;
        }
    }
}
