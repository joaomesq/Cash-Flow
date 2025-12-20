<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class ListaMensal extends Component
{
    public $transacoes;

    public function render()
    {
        return view('livewire.transacao.lista-mensal');
    }

    public function mount(){
        $this->transacoes = $this->getTransacaoService()->getMensal(ano: now()->format('Y'), mes: now()->format('m'));
    }

    #[On('transacao-criada')]
    #[On('alterar-data')]
    public function atualizarLista(int $ano, int $mes){
        $this->transacoes = $this->getTransacaoService()->getMensal(ano: $ano, mes: $mes);
    }

    private function getTransacaoService(){
        return new TransacaoService(userId: Auth::user()->id);
    }
}
