<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class ResumoMensal extends Component
{
    public $receita;
    public $despesa;
    public $data;
    public $saldo;

    public function mount(){
        $this->data = now()->format('m - Y');
        $this->receita = $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'receita');
        $this->despesa = $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'despesa');
        $this->calcularSaldo();
    }

    public function render()
    {
        return view('livewire.transacao.resumo-mensal');
    }

    #[On('transacao-criada')]
    public function atualizarValores(int $ano, int $mes){
        list($mesAtual, $anoAtual) = explode('-', $this->data);
        
        if($mesAtual == $mes && $anoAtual == $ano){
            $this->receita = $this->getTransacaoService()->resumoMensal(ano: $anoAtual, mes: $mesAtual, tipo: 'receita');
            $this->despesa = $this->getTransacaoService()->resumoMensal(ano: $anoAtual, mes: $mesAtual, tipo: 'despesa');
            $this->calcularSaldo();
        }
    }

    public function nextMonth(){
        list($mes, $ano) = explode('-', $this->data);
        
        //checando o mês
        if($mes >= 12){
            $ano += 1;
            $mes = 1;
        }else{
            $mes += 1;
        }

        //atualizando dados
        $this->receita = $this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'receita');
        $this->despesa = $this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'despesa');
        $this->calcularSaldo();

        $this->data = $mes." - ".$ano;
    }

    public function backMonth(){
        list($mes, $ano) = explode('-', $this->data);
        
        //checando o mês
        if($mes <= 1){
            $ano -= 1;
            $mes = 12;
        }else{
            $mes -= 1;
        }

        //atualizando dados
        $this->receita = $this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'receita');
        $this->despesa = $this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'despesa');
        $this->calcularSaldo();

        $this->data = $mes." - ".$ano;
    }

    private function calcularSaldo(){
        $this->saldo = $this->receita - $this->despesa;
    }
    private function getTransacaoService(){
        return new TransacaoService(Auth::user()->id);
    }
}
