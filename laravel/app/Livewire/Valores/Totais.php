<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Totais extends Component
{
    public $saldo;
    public $receita;
    public $despesa;

    public function render()
    {
        $this->receita = $this->somarTransacoes(tipo: 'receita');
        $this->despesa = $this->somarTransacoes(tipo: 'despesa');
        $this->saldo = $this->receita - $this->despesa;
        return view('livewire.valores.totais');
    }


    private function somarTransacoes(string $tipo){
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes(tipo: $tipo, periodo: 'todo');
        $total = 0;
        foreach($transacoes as $transacao):
            $total += $transacao->total;
        endforeach;
        return $total;
    }
}
