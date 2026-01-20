<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Symfony\Component\String\b;

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

        if(strtolower($direcao) == "next"):
            $this->nextPeriodo();
        elseif(strtolower($direcao) == "back"):
            $this->backPeriodo();
        endif;

        //disparando evento
        $this->dispatch("alterar-periodo", periodo: $this->periodo);
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
    private function backPeriodo(){
        switch (strtolower($this->periodo)) {
            case 'todo':
                $this->periodo = "Anual";
                break;
            case 'anual':
                $this->periodo = "Mensal";
                break;
            case 'mensal':
                $this->periodo = "Diario";
                break;
            case 'diario':
               $this->periodo = "Todo";
               break;
        }
    }

    public function alterarData(string $direcao = "next"){
        if(strtolower($direcao) == "next"):
            switch (strtolower($this->periodo)) {
                case 'mensal':
                    $this->nextMonth();
                    break;
                
                case 'anual':
                    $this->alterarAno(direcao: "next");
                    break;
                
                case 'diario':
                    $this->alterarDia("next");
                    break;
            }
        elseif(strtolower($direcao) == 'back'):
            switch (strtolower($this->periodo)) {
                case 'mensal':
                    $this->backtMonth();
                    break;
                
                case 'anual':
                    $this->alterarAno(direcao: 'back');
                    break;
                
                case 'diario':
                    $this->alterarDia("back");
                    break;
            }
        endif;
        
    }
    
    private function nextMonth(){
        if($this->mes >= 12):
            $this->mes = 01;
            $this->alterarAno("next");
        elseif($this->mes < 12 & $this->mes >= 1):
            $this->mes += 1;
        endif;

        //disparando evento
        $this->dispatch('alterar-mes', mes: $this->mes);
    }
    private function backtMonth(){
        if($this->mes <= 1):
            $this->mes = 12;
            $this->alterarAno("back");
        elseif($this->mes > 1 & $this->mes <= 12):
            $this->mes -= 1;
        endif;

        //disparando evento
        $this->dispatch('alterar-mes', mes: $this->mes);
    }

    public function alterarAno(string $direcao = "next"){
        if(strtolower($direcao) == "next" ):
            $this->ano += 1;
        elseif(strtolower($direcao) == "back"):
            $this->ano -= 1;
        endif;

        //diparando evento
        $this->dispatch('alterar-ano', ano: $this->ano);
    }
    
    private function alterarDia(string $direcao = "next"){
        //pegar número de dias do mês
        $numeroDeDias = cal_days_in_month(CAL_GREGORIAN, $this->mes, $this->ano);
        
        switch(strtolower($direcao)){
            case 'next':
                if($this->dia >= $numeroDeDias):
                    $this->nextMonth();
                    $this->dia = 01;
                else:
                    $this->dia += 1;
                endif;

                break;
            
            case 'back':
                if($this->dia <= 1):
                    $this->backtMonth();
                    $this->dia = cal_days_in_month(CAL_GREGORIAN, $this->mes, $this->ano);
                else:
                    $this->dia -= 1;
                endif;

                break;
        }

        $this->dispatch('alterar-dia', dia: $this->dia);
    }
}
