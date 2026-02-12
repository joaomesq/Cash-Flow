<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
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
    public $despesa;

    public function mount(){
        $this->periodo = "mensal";
        $this->dia = date('d');
        $this->mes = date('m');
        $this->ano = date('Y');
        $this->despesa = 0;
    }

    public function render()
    {
        $this->calcularReceita(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.valores.despesa');
    }

    public function calcularReceita(TransacaoService $transacaoService){
        $this->despesa = $transacaoService->despesa(ano: $this->ano, mes: $this->mes, dia: $this->dia, periodo: $this->periodo);
    }
}
