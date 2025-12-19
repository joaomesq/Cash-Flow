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
        return Transacao::with('user')->where('usuario_id', $this->idUser)->paginate(10);
    }

    public function getMensal(int $ano, int $mes){
        return Transacao::whereYear('data', $ano)->whereMonth('data', $mes)->where('usuario_id', $this->idUser)
                        ->orderBy('created_at', 'desc')->limit(15)->get();
    }

    public function inserir(float $valor, string $tipo = 'receita', string $categoria, string $descricao, string $data){
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
}