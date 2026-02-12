<?php

namespace App\Livewire\Valores;

use Livewire\Component;

/**
 * Componet que calcula a despesa feita
 * 
 * Este componente calcula o  total das despesas feitas para determinado periodo[mensal, anual, diario, todo]
 * @param string $periodo = [mensal, anual, diario, todo] default = todo
 * @param int $dia = define o mês para a despesa - default = date('d') 
 * @param int $mes = define o mês para o despesa - default = date('m')
 * @param int $ano = define o ano para a despesa - default = date('Y')
 **/
class Despesa extends Component
{
    public $periodo;
    public $dia;
    public $mes;
    public $ano;
    public $receita;

    public function mount(){
        $this->periodo = "mensal";
        $this->dia = date('d');
        $this->mes = date('m');
        $this->ano = daet('Y');
        $this->receita = 0;
    }

    public function render()
    {
        return view('livewire.valores.despesa');
    }
}
