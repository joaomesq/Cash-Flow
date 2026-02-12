<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
/**
 * Componet que calcula o saldo disponivel
 * 
 * Este componente calcula o saldo disponivel para determinado periodo[mensal, anual, diario todo]
 * @param string $perido = [mensal, anual, diario, todo] default = todo
 * @param int $dia = define o dia para o saldo - default = date('d') 
 * @param int $mes = define o mês para o saldo - default = date('m')
 * @param int $ano = define o ano para o saldo - default = date('Y')
 **/

class Saldo extends Component
{
    public $periodo;
    public $dia;
    public $mes;
    public $ano;
    public $saldo;

    public function mount(){
        $this->periodo = 'todo';
        $this->dia = date('d');
        $this->mes = date('m');
        $this->ano = date('Y');
        $this->saldo = 0;
    }

    public function render()
    {
        $this->calcularSaldo(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.valores.saldo');
    }

    public function calcularSaldo(TransacaoService $transacaoService){
        $this->saldo = $transacaoService->saldo(ano: $this->ano, mes: $this->mes, dia: $this->dia, periodo: $this->periodo);   
    }
}
