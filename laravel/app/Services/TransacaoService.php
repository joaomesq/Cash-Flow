<?php
namespace App\Services;

use App\Models\Transacao;
use Illuminate\Support\Facades\DB;

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
                        ->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Exclui completamente a transação da base de dados
     * @param int $id = id da transação a ser eliminada
     */
    public function delete(int $id){
        if(!empty($id)){
            return Transacao::where('id', $id)->where('usuario_id', $this->idUser)->delete();
        }
        return false;
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
     * Pega as últimas transações realizadas, tem como limite maximo 8 transações.
     * @param int $limite limita o número de transações, por padrão 4. 
     * @param string $tipo diz qual tipo[recita, despesa] de transação queremos pegar. Caso não for passado pega todos os tipos
     */
    public function ultimasTransacoes(int $limite = 4){
        if($limite > 8):
            $limite = 8;
        endif;

        return Transacao::query()->where('usuario_id', $this->idUser)
                        ->orderBy('data', 'desc')->orderBy('created_at', 'desc')->limit($limite)->get();
    }

    /**
     * Pega os valoes, com base no tipo[receita, despesa], das transação realizadas 
     * em determinado periodo[mensal, anaul, diario, todo] soma e retorna os totais
     * Esses totais são gerados agrupando os valores de acordo com alguma coluna
     * @param string $tipo - [receita, despesa]
     * @param string $coluna [descricao, categoria] - determina se os valoes devem ser baseado em categoria ou descricao
     * @param string $periodo - permite define o periodo de tempo para o qual queremos os valores, default mensal
     * @param int|null $ano, $mes, $dia - permite definir o filtro do periodo escolhido, valor default é null
    */
    public function resumoTransacoes(string $tipo, string $coluna = 'descricao', int|null $ano = null, int|null $mes = null, int|null $dia = null, string $periodo = "mensal"){
        //checar coluna && tipo
        $coluna = ( $coluna != 'descricao') ? 'categoria' : $coluna ;
        $tipo = ( $tipo != 'receita' ) ? 'despesa': $tipo;

        switch (strtolower($periodo)) {
            case 'diario':
                if($dia == null || $ano == null || $mes == null):
                    return False;
                endif;
                return Transacao::query()->select($coluna, DB::raw("SUM(valor) as total"))->whereYear('data', $ano)
                            ->whereMonth('data', $mes)->whereDay('data', $dia)->where('usuario_id', $this->idUser)
                            ->where('tipo', $tipo)->groupBy($coluna)->orderBy($coluna)->get();
                break;
            
            case 'mensal':
                if($mes == null || $ano == null):
                    return False;
                endif;

                return Transacao::query()->select($coluna, DB::raw("SUM(valor) as total"))
                            ->whereYear('data', $ano)->whereMonth('data', $mes)->where('usuario_id', $this->idUser)
                            ->where('tipo', $tipo)->groupBy($coluna)->orderBy($coluna)->get();
                break;
            
            case 'anual':
                if($ano == null):
                    return False;
                endif;

                return Transacao::query()->select($coluna, DB::raw("SUM(valor) as total"))
                            ->whereYear('data', $ano)->where('usuario_id', $this->idUser)->where('tipo', $tipo)
                            ->groupBy($coluna)->orderBy($coluna)->get();
                break;
            
            case 'todo':
                return Transacao::query()->select($coluna, DB::raw("SUM(valor) as total"))->where('usuario_id', $this->idUser)
                            ->where('tipo', $tipo)->groupby($coluna)->orderBy($coluna)->get();

            default:
                return False;
                break;
        }
    }

    /**
     * Calcula o saldo disponivel para determinado periodo[mensal, anual, diario, todo]
     * @param int|null $ano - ano para o calculo do saldo
     * @param int|null $mes - mes para o calculo do saldo
     * @param int|null $dia - dia para o calculo do saldo
     * @param string $periodo - periodo de tempo para o qual queremos os valores, default mensal
     */
    public function saldo(int $ano, int $mes, int $dia, string $periodo = "mensal"){
        return ($this->receita($ano, $mes, $dia, $periodo) - $this->despesa($ano, $mes, $dia, $periodo));
    }

    public function receita(int $ano, int $mes, int $dia, string $periodo = "mensal"){
        $transacoes = $this->resumoTransacoes(tipo: 'receita', coluna: 'categoria', ano: $ano, mes: $mes, dia: $dia, periodo: $periodo);
        if(!$transacoes):
            return 0;
        endif;
        return $transacoes->sum('total');
    }

    public function despesa(int $ano, int $mes, int $dia, string $periodo = "mensal"){
        $transacoes = $this->resumoTransacoes(tipo: 'despesa', coluna: 'categoria', ano: $ano, mes: $mes, dia: $dia, periodo: $periodo);
        if(!$transacoes):
            return 0;
        endif;
        return $transacoes->sum('total');
    }
}