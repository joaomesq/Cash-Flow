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
        $this->data = now()->format('m - Y');
        $this->receita = $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'receita');
        $this->despesa = $this->getTransacaoService()->resumoMensal(ano: now()->format('Y'), mes: now()->format('m'), tipo: 'despesa');
    }
    
    public function render()
    {
        return view('livewire.transacao.resumo-mensal');
    }

    private function getTransacaoService(){
        return new TransacaoService(Auth::user()->id);
    }
}
