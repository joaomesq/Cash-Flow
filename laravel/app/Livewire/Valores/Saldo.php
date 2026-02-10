<?php

namespace App\Livewire\Valores;

use Livewire\Component;

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
    public $mes;
    public $ano;

    public function mount(){
        $this->periodo = 'todo';
        $this->mes = now('m');
        $this->ano = now('Y');
    }

    public function render()
    {
        return view('livewire.valores.saldo');
    }
}
