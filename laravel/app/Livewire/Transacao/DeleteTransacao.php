<?php

namespace App\Livewire\Transacao;

use App\Models\Transacao;
use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteTransacao extends Component
{
    public $id;

    public function render()
    {
        return view('livewire.transacao.delete-transacao');
    }

    public function delete(){
        if((new TransacaoService(userId: Auth::user()->id))->delete($this->id)):
            $this->dispatch('transacao-deletada');
        endif;
    }
}
