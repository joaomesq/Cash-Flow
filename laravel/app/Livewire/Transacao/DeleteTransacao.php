<?php

namespace App\Livewire\Transacao;

use Livewire\Component;

class DeleteTransacao extends Component
{
    public $idTransacao;
    
    public function render()
    {
        return view('livewire.transacao.delete-transacao');
    }
}
