<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResumoReceita extends Component
{
    public $receitas;
    
    public function render()
    {   $this->setReceitas(new TransacaoService(userId: Auth::user()->id));
        return view('livewire.transacao.resumo-receita');
    }

    public function setReceitas(TransacaoService $transacaoService){
        $this->receitas = $transacaoService->resumoTransacoes(tipo: 'receita', coluna: "categoria", periodo: 'todo');
    }
}
