<?php

namespace App\Livewire\Graficos;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FluxoCaixa extends Component
{
    public $periodo = "mensal";
    public $labels = [];
    public $receitas = [];
    public $despesas = [];

    public function render()
    {
        $this->estruturaDados();
        return view('livewire.graficos.fluxo-caixa', [
            'labels' => $this->labels,
            'receitas' => $this->receitas,
            'despesas' => $this->despesas
        ]);
    }

    public function dadosGrafico(TransacaoService $transacaoService){
        return $transacaoService->dadosGrafico(periodo: $this->periodo);
    }
    
    /**
     *  Estrutura os dados para o grafico - Chart
     */
    private function estruturaDados(){
        // Resetar arrays para evitar duplicação ou dados antigos
        $this->labels = [];
        $this->receitas = [];
        $this->despesas = [];

        $dadosBrutos = $this->dadosGrafico(new TransacaoService(userId: Auth::user()->id ));
        
        //definindo o formato do label
        if($this->periodo == "semanal"){
            $formatoLabel = 'd/m';
        }elseif($this->periodo == "mensal"){
            $formatoLabel = 'd/m';
        }elseif($this->periodo == "todo"){
            $formatoLabel = 'M/Y';
        } else {
             $formatoLabel = 'd/m';
        }

        $receitasTemp = [];
        $despesasTemp = [];

        // Preencher labels e separar dados temporariamente
        foreach ($dadosBrutos as $dado) {
            $dataLabel = \Carbon\Carbon::parse($dado->data_agrupada)->format($formatoLabel); // Formata para exibição
            
            if (!in_array($dataLabel, $this->labels)) {
                $this->labels[] = $dataLabel;
            }
            if ($dado->tipo === 'receita') {
                $receitasTemp[$dataLabel] = $dado->total;
            } else {
                $despesasTemp[$dataLabel] = $dado->total;
            }
        }

         // Garantir que todos os labels tenham valor (0 se não houver transação)  
         // Popula as propriedades públicas que serão arrays indexados (Listas)
        foreach ($this->labels as $label) {
            $this->receitas[] = $receitasTemp[$label] ?? 0;
            $this->despesas[] = $despesasTemp[$label] ?? 0;
        }
    }

    // Método para atualizar o período via clique no botão
    public function setPeriodo($novoPeriodo)
    {
        $this->periodo = $novoPeriodo;
    }
}
