<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UltimasTransacoes extends Component
{
    public $transacoes;

    public function render()
    {
        $this->pegarTransacoes(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.transacao.ultimas-transacoes');
    }

    public function pegarTransacoes(TransacaoService $transacaoService){
        $this->transacoes = $transacaoService->ultimasTransacoes(8);
    }
}
