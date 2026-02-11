<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
/**
 * Componet que calcula o saldo disponivel
 * 
 * Este componente calcula o saldo disponivel para determinado periodo[mensal, anual, todo]
 * @param string $perido = [mensal, anual, todo] default = todo 
 * @param int $mes = define o mês para o saldo - default = now
 * @param int $ano = define o ano para o saldo - default = now
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
        $this->dia = now()->format('d');
        $this->mes = now()->format('m');
        $this->ano = now()->format('Y');
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
