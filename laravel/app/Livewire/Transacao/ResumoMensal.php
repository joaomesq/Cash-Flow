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
        
        $this->calcularReceita(ano: now()->format('Y'), mes: now()->format('m'));
        $this->calcularDespesa(ano: now()->format('Y'), mes: now()->format('m'));
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
            $this->calcularReceita(ano: $anoAtual, mes: $mesAtual);
            $this->calcularDespesa(ano: $anoAtual, mes: $mesAtual);
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
        $this->calcularReceita(ano: $ano, mes: $mes);
        $this->calcularDespesa(ano: $ano, mes: $mes);
        $this->calcularSaldo();

        $this->data = $mes." - ".$ano;

        //evento para a lista mensal
        $this->dispatch('alterar-data', ano: $ano, mes: $mes)->to(ListaMensal::class);
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
        $this->calcularReceita(ano: $ano, mes: $mes);
        $this->calcularDespesa(ano: $ano, mes: $mes);
        $this->calcularSaldo();

        $this->data = $mes." - ".$ano;

        //evento para a lista mensal
        $this->dispatch('alterar-data', ano: $ano, mes: $mes)->to(ListaMensal::class);
    }

    private function calcularReceita(int $ano, int $mes){
        $transacoes = $this->getTransacaoService()->resumoTransacoes(tipo: 'receita', ano: $ano, mes: $mes);
        $total = 0;
        foreach ($transacoes as $transacao) {
            $total += $transacao->total;
        }

        $this->receita = $total;
    }

    private function calcularDespesa(int $ano, int $mes){
        $transacoes = $this->getTransacaoService()->resumoTransacoes(tipo: 'despesa', ano: $ano, mes: $mes);
        $total = 0;
        foreach ($transacoes as $transacao) {
            $total += $transacao->total;
        }

        $this->despesa = $total;
    }

    private function calcularSaldo(){
        $this->saldo = $this->receita - $this->despesa;
    }
    private function getTransacaoService(){
        return new TransacaoService(Auth::user()->id);
    }
}
