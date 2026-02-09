<?php

namespace App\Livewire\Transacao;

use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Symfony\Component\Clock\now;

class RegisterTransacao extends Component
{
    public $valor;
    public $tipo;
    public $descricao;
    public $categoria;
    public $data;

    //Resetar as variaveis na model
    public $formKey = 0;

    public $categorias = [
        'venda'=> "Venda", "compra"=> "Compra", "pagamento"=> "Pagamento",
        'despesa-fixa'=> "Despesa fixa", 'despesa-variavel'=> "Despesa variável",
        'investimento'=> "Investimento", 'recebimento'=> "Recebimento", 'gasto-nao-essencial'=> "Gasto não essencial",
        'outros'=> "Outros",
    ];

    protected $rules = [
        'descricao'=> 'required|min:3', 'categoria'=> 'required',
        'valor'=> 'required|numeric|min:0.01', 'tipo'=> 'required',
        'data'=> 'required',
    ];

    protected $messages = [
        'descricao.required'=> 'A descrição é obrigatória', 
        'descricao.min'=> 'A descrição precisa ter no minímo 3 letras', 'valor.required'=> 'O valor é obrigatório',
        'valor.numeric'=> 'O valor precisa ser um número', 'valor.min'=> 'O valor precisa ser maior que 0', 
        'tipo.required'=> 'O tipo é obrigatório', 'data.required'=> 'A data é obrigatória'
    ];

    public function render()
    {
        return view('livewire.transacao.register-transacao');
    }

    public function salvar(){
        $this->validate();
        $sucesso = $this->getServiceTransacao()->inserir(valor: $this->valor, tipo: $this->tipo, categoria: $this->categoria, descricao: $this->descricao, data: $this->data);
        
        if($sucesso):
            //enviar evento para resumo mensal
            list($ano, $mes, $dia) = explode('-', $this->data);
            $this->dispatch('transacao-criada', ano: $ano, mes: $mes);
        endif;        

        //$this->reset(['descricao', 'categoria', 'valor', 'data']);
        $this->reset();
        $this->formKey++;
    }

    private function getServiceTransacao(){
        return new TransacaoService(userId: Auth::user()->id);
    }
}
