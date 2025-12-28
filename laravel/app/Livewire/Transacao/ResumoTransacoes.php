<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResumoTransacoes extends Component
{
    public $transacoes;
    
    public function render()
    {
        $this->transacoes = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes('despesa', 'categoria');
        return view('livewire.transacao.resumo-transacoes');
    }
}
