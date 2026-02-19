<?php

namespace App\Livewire\Valores;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Receita extends Component
{
    public $periodo = "todo";
    public $dia;
    public $mes;
    public $ano;
    public $receita;

    public function mount(){
        $this->ano = date('Y');
        $this->mes = date('m');
        $this->dia = date('d');
        $this->receita =  0;
    }

    public function render()
    {
        $this->calcularReceita( new TransacaoService(userId: Auth::user()->id));
        return view('livewire.valores.receita');
    }

    public function calcularReceita(TransacaoService $transacaoService){
        $this->receita = $transacaoService->receita(periodo: $this->periodo, ano: $this->ano, mes: $this->mes, dia: $this->dia);
    }
}
