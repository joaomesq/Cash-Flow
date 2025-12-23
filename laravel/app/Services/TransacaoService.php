<?php
namespace App\Services;

use App\Models\Transacao;

class TransacaoService{
    private $idUser;

    public function __construct(int $userId)
    {
        $this->idUser = $userId;
    }

    public function getAll(){
        return Transacao::where('usuario_id', $this->idUser)->orderBy('data', 'desc')->orderBy('created_at', 'desc')
                        ->paginate(15);
    }

    public function getMensal(int $ano, int $mes){
        return Transacao::whereYear('data', $ano)->whereMonth('data', $mes)->where('usuario_id', $this->idUser)
                        ->orderBy('created_at', 'desc')->limit(15)->get();
    }

    public function inserir(float $valor, string $tipo = 'receita', string $categoria, string $descricao, $data){
        //validar os campos
        if(empty($valor) || empty($categoria) || empty($categoria) || empty($data)):
            return false;
        endif;

        //checar tipos
        $tipos = ['receita', 'despesa'];
        if(!in_array($tipo, $tipos)):
            return false;
        endif;

        return  Transacao::create([
            'valor'=> $valor, 'categoria'=> $categoria, 'tipo'=> $tipo,
            'usuario_id'=> $this->idUser, 'descricao'=> $descricao, 'data'=> $data
        ]);
    }

    public function buscar(string|null $descricao = null, string|null $categoria = null, float|null $valor = null, string|null $tipo = null, $dataInicio = null, $dataFim = null){
        return Transacao::query()->when($descricao, fn($q)=> $q->where('descricao', 'LIKE', "{$descricao}%"))
                            ->when($categoria, fn($q)=> $q->where('categoria', 'LIKE', "{$categoria}%"))
                            ->when($tipo, fn($q)=> $q->where('tipo', $tipo))
                            ->when($valor, fn($q)=> $q->where('valor', 'LIKE', "{$valor}%"))
                            ->when($dataInicio, fn($q)=> $q->whereDate('data', '>=', $dataInicio))
                            ->when($dataFim, fn($q)=> $q->whereDate('data', '<=', $dataFim))
                            ->where('usuario_id', $this->idUser)->orderBy('data', 'desc')->orderBy('created_at', 'desc')
                            ->paginate(15);
    }

    /**
     * Esta função pega os valores com base no tipo[receita, despesa] de transações realizadas durante o mês 
     * de um determinado ano, realiza a soma e retorna o total
     * @param int $ano - ano onde buscamos o mês
     * @param int $mes - mês para o qual deve ser gerado o resumo ou total
     * @param string $tipo - para qual tipo de transação devemos gerar o resumo[receita, despesa]
     */
    public function resumoMensal(int $ano, int $mes, string $tipo){
        $valores = Transacao::whereMonth('data', $mes)->whereYear('data', $ano)->where('usuario_id', $this->idUser)
                            ->where('tipo', $tipo)->orderBy('data')->get('valor');
        $total = 0.00;
        foreach($valores as $value):
            $total += $value->valor;
        endforeach;

        return $total;    
    }

    /**
     * Pega as últimas transações realizadas, tem como limite maximo 8 transações.
     * @param int $limite limita o número de transações, por padrão 4. 
     * @param string $tipo diz qual tipo[recita, despesa] de transação queremos pegar. Caso não for passado pega todos os tipos
     */
    public function ultimasTransacoes(int $limite = 4, string|null $tipo = null){
        if($limite > 8):
            $limite = 8;
        endif;

        if($tipo != null && !in_array($tipo, ['receita', 'despesa'])):
            $tipo = null;
        endif;

        return Transacao::query()->when($tipo, fn($q)=> $q->where('tipo', $tipo))->where('usuario_id', $this->idUser)
                        ->orderBy('data', 'desc')->orderBy('created_at', 'desc')->limit($limite)->get();
    }
}