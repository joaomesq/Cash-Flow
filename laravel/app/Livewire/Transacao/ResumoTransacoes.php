<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResumoTransacoes extends Component
{
    public $receitas;
    public $despesas;
    private $ano;
    private $mes;
    private $dia;
    private $periodo;

    public function mount(){
        $this->ano = now()->format('Y');
        $this->mes = now()->format('m');
        $this->dia = now()->format('d');
        $this->periodo = 'mensal';
    }

    public function render()
    {
        $this->despesas = (new TransacaoService(userId: Auth::user()->id))
                    ->resumoTransacoes(tipo: 'despesa', ano: $this->ano, mes: $this->mes, periodo: $this->periodo, dia: $this->dia);
    
        $this->receitas = (new TransacaoService(userId: Auth::user()->id))
                    ->resumoTransacoes(tipo: 'receita', ano: $this->ano, mes: $this->mes, periodo: $this->periodo, dia: $this->dia);

        return view('livewire.transacao.resumo-transacoes');
    }


}
