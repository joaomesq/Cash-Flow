<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Listar extends Component
{
    use WithPagination;
    
    public function render()
    {
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->getAll();
        return view('livewire.transacao.listar', compact('transacoes'));
    }
}
