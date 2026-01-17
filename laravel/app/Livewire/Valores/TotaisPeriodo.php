<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TotaisPeriodo extends Component
{
    public $periodo;
    public $data;
    public $ano;
    public $mes;
    public $dia;
    public $receita;
    public $despesa;
    public $saldo;

    public function mount(){
        $this->periodo = "Mensal";
        $this->ano = now()->format("Y");
        $this->mes = now()->format("m");
        $this->dia = now()->format("d");
    }

    public function render()
    {
        $this->calcularReceita();
        $this->calcularDespesa();
        $this->saldo = $this->receita - $this->despesa;
        $this->montarData();

        return view('livewire.valores.totais-periodo');

    }

    private function calcularReceita(){
        $this->receita = $this->calcularTotal('receita');
    }

    private function calcularDespesa(){
        $this->despesa = $this->calcularTotal('despesa');
    }

    private function calcularTotal(string $tipo){
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes(tipo: $tipo, ano: $this->ano, mes: $this->mes, dia: $this->dia, periodo: $this->periodo);
        
        if(!$transacoes):
            return 0;
        endif;

        $total = 0;
        foreach($transacoes as $transacao){
            $total += $transacao->total;
        }
        return $total;
    }

    private function montarData(){
        switch (strtolower($this->periodo)) {
            case 'mensal':
                $this->data = $this->mes." - ".$this->ano;
                break;
            
            case 'anual':
                $this->data = $this->ano;
                break;
            
            case 'diario':
                $this->data = $this->dia." - ".$this->mes." - ".$this->ano;
                break;

            default:
                $this->data = "Todo";
                break;
        }
    }

    public function trocarPeriodo(string $direcao){
        $listaPeriodos = ['anual', 'mensal', 'diario', 'todo'];
        //Checar periodo
        if(!in_array(strtolower($this->periodo), $listaPeriodos)):
            $this->periodo == "Mensal";
            return;
        endif; 

        if($direcao == "next"):
            $this->nextPeriodo();
        endif;
    }
    private function nextPeriodo(){
        switch (strtolower($this->periodo)) {
            case 'diario':
                $this->periodo = "Mensal";
                break;
            case 'mensal':
                $this->periodo = "Anual";
                break;
            case 'anual':
                $this->periodo = "Todo";
                break;
            case 'todo':
                $this->periodo = "Diario";
                break;
        }
    }
}
