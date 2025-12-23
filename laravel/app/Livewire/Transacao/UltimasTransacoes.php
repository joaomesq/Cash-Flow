<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UltimasTransacoes extends Component
{
    public $receitas;
    public $despesas;

    public function render()
    {
        $this->receitas = (new TransacaoService(userId: Auth::user()->id))->ultimasTransacoes(tipo: 'receita');
        $this->despesas = (new TransacaoService(userId: Auth::user()->id))->ultimasTransacoes(tipo: 'despesa');
        return view('livewire.transacao.ultimas-transacoes');
    }
}
