<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResumoTransacoes extends Component
{
    public $receitas;
    public $despesas;

    public function render()
    {
        $this->despesas = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes('despesa');
        $this->receitas = (new TransacaoService(userId: Auth::user()->id))->resumoTransacoes(tipo: 'receita');
        return view('livewire.transacao.resumo-transacoes');
    }
}
