<?php


namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ResumoDespesa extends Component
{
    use WithPagination;

    public $total = 0;
    public $filtro = "categoria";
    
    public function render()
    {   
        $despesas = $this->setDespesas(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.transacao.resumo-despesa', compact('despesas'));
    }

    public function setDespesas(TransacaoService $transacaoService){
        return $transacaoService->resumoTransacoes(tipo: 'despesa', coluna: strtolower($this->filtro), periodo: 'todo');
    }

    public function alterarFiltro(string $filtro = "categoria"){
        $this->filtro = $filtro;
    }
    
    private function calcularTotal(array $despesas){
        foreach ($despesas as $despesa) {
            $this->total += $despesa->total;
        }
    }
}