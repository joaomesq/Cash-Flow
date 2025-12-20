<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Symfony\Component\Clock\now;

class ListaMensal extends Component
{
    use WithPagination;

    public $ano;
    public $mes;

    public function mount(){
        $this->ano = now()->format('Y');
        $this->mes = now()->format('m');
    }

    public function render()
    {
        $transacoes = (new TransacaoService(userId: Auth::user()->id))->getMensal(ano: $this->ano, mes: $this->mes);
        return view('livewire.transacao.lista-mensal', compact('transacoes'));
    }

    #[On('transacao-criada')]
    #[On('alterar-data')]
    public function atualizarLista(int $ano, int $mes){
        if($ano === $this->ano && $mes === $this->mes){
            $this->resetPage();
        }else{
            $this->ano = $ano;
            $this->mes = $mes;
            $this->resetPage();
        }

    }
}
