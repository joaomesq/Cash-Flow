<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class ResumoMensal extends Component
{
    public $receita;
    public $despesa;
    public $data;
    public $saldo;
    private $transacaoService;
    
    public function mount(){
        $this->data = now()->format('m - Y');
        $this->receita = number_format( $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'receita'), 2, ',', '.');
        $this->despesa = number_format( $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'despesa'), 2, ',', '.');
    }

    public function render()
    {
        return view('livewire.transacao.resumo-mensal');
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
        $this->receita = number_format($this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'receita'), 2, ',', '.');
        $this->despesa = number_format($this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'despesa'), 2, ',', '.');

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
        $this->receita = number_format($this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'receita'), 2, ',', '.');
        $this->despesa = number_format($this->getTransacaoService()->resumoMensal(ano: $ano, mes: $mes, tipo: 'despesa'), 2, ',', '.');

        $this->data = $mes." - ".$ano;
    }

    private function getTransacaoService(){
        return new TransacaoService(Auth::user()->id);
    }
}
