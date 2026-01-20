<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Percentagens extends Component
{
    public $receita;
    public $despesa;
    
    public $ano, $mes, $dia;
    public $periodo;

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
        $receita = ($total == 0) ? 0 : ($this->pegarTotal('receita')/$total) * 100 ;
        $despesa = ($total == 0) ? 0: ($this->pegarTotal('despesa')/$total) *100;

        if(strtolower($tipo) == 'receita'):
            return $receita;
        elseif(strtolower($tipo) == 'despesa'):
            return $despesa;
        endif;
    }

    private function pegarTotal(string $tipo){
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes(tipo: strtolower($tipo), ano: $this->ano, mes: $this->mes, dia: $this->dia, periodo: strtolower($this->periodo));
        
        if(!$transacoes):
            return 0.00;
        endif;

        $total = 0;
        foreach ($transacoes as $transacao) {
            $total += $transacao->total;
        }
        return $total;
    }

    #[On('alterar-periodo')]
    public function atualizarPeriodo(string $periodo){
        if(strtolower($this->periodo) != $periodo):
            $this->periodo = $periodo;
        endif;
    }

    #[On('alterar-ano')]
    public function atualizarAno(int $ano){
        if($this->ano != $ano):
            $this->ano = $ano;
        endif;
    }

    #[On('alterar-mes')]
    public function atualizarMes(int $mes){
        if($this->mes != $mes):
            $this->mes = $mes;
        endif;
    }

    #[On('alterar-dia')]
    public function atualizarDia(int $dia){
        if($this->dia != $dia){
            $this->dia = $dia;
        }
    }


}
