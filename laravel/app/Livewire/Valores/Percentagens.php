<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Percentagens extends Component
{
    public $receita;
    public $despesa;
    
    private $ano, $mes, $dia;
    private $periodo;

    public function mount(){
        $this->periodo = 'mensal';
        $this->ano = now()->format('Y');
        $this->mes = now()->format('m');
        $this->dia = now()->format('d');
    }

    public function render()
    {
        $this->receita = $this->calcularPercentagem('receita');
        $this->despesa = $this->calcularPercentagem('despesa');
        return view('livewire.valores.percentagens');
    }

    private function calcularPercentagem(string $tipo){
        $total = $this->pegarTotal('receita') + $this->pegarTotal('despesa');
        
        if(strtolower($tipo) == 'receita'):
            return ($this->pegarTotal('receita')/$total) * 100;
        elseif(strtolower($tipo) == 'despesa'):
            return ($this->pegarTotal('despesa')/$total) * 100;
        endif;
    }

    private function pegarTotal(string $tipo){
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes(tipo: strtolower($tipo), ano: $this->ano, mes: $this->mes, dia: $this->dia, periodo: $this->periodo);
        
        $total = 0;
        foreach ($transacoes as $transacao) {
            $total += $transacao->total;
        }
        return $total;
    }
}
