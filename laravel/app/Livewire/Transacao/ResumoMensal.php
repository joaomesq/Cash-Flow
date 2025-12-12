<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class ResumoMensal extends Component
{
    public $receita;
    public $despesa;
    public $data;
    public $saldo;
    private $transacaoService;
    
    public function mount(){
        $this->transacaoService = new TransacaoService(Auth::user()->id);
        $this->data = now()->format('m - Y');
    }

    public function render()
    {
        return view('livewire.transacao.resumo-mensal');
    }
}
