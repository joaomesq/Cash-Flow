<?php

namespace App\Livewire\Valores;

use Livewire\Component;

class Saldo extends Component
{
    public $priodo;
    public $mes = null;
    public $ano = null;

    public function render()
    {
        return view('livewire.valores.saldo');
    }
}
