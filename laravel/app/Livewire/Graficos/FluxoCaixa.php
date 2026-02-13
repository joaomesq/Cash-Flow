<?php

namespace App\Livewire\Graficos;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FluxoCaixa extends Component
{
    public $periodo = "mensal";
    public $labels = [];
    public $dadosReceita = [];
    public $dadosDespesa = [];

    public function render()
    {
        $dados = $this->dadosGrafico(new TransacaoService(userId: Auth::user()->id ));
        return view('livewire.graficos.fluxo-caixa', compact('dados'));
    }

    public function dadosGrafico(TransacaoService $transacaoService){
        return $transacaoService->dadosGrafico(periodo: $this->periodo);
    }
    
    /**
     *  Estrutura os dados para o grafico - Chart
     */
    private function estruturaDados(){
        $dadosBrutos = $this->dadosGrafico(new TransacaoService(userId: Auth::user()->id ));
        
        //definindo o formato do label
        if($this->periodo == "semanal"){
            $formatoLabel = 'd/m/Y';
        }elseif($this->periodo == "mensal"){
            $formatoLabel = 'm/Y';
        }elseif($this->periodo == "todo"){
            $formatoLabel = 'M/Y';
        }

        $receitas = [];
        $despesas = [];
        
        // Preencher labels e separar dados
        foreach ($dadosBrutos as $dado) {
            $dataLabel = \Carbon\Carbon::parse($dado->data_agrupada)->format($formatoLabel); // Formata para exibição
            
            if (!in_array($dataLabel, $labels)) {
                $labels[] = $dataLabel;
            }
            if ($dado->tipo === 'receita') {
                $receitas[$dataLabel] = $dado->total;
            } else {
                $despesas[$dataLabel] = $dado->total;
            }
        }
    }
}
