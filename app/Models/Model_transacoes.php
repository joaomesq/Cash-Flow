<?php
require_once dirname(__DIR__, 2).'/config/connect.php';

class Transacoes extends Database{
    private $table;

    public function __construct(){
        parent::__construct();
        $this->table = 'transacoes';
    }

    public function realizar_transacao(string $descricao, string $categoria, string $tipo, string $data, float|int $valor, int $usuario){
        $descricao = $this->clear($descricao);
        $categoria = $this->clear($categoria);
        $tipo = $this->clear($tipo);
        $valor = $this->clear($valor);
        $usuario = $this->clear($usuario);
        $data = $this->clear($data);
        $semana = date('W');
        list($ano, $mes, $dia) = explode('-', $data);
        
        $sql = "INSERT INTO $this->table (valor, usuario, tipo, categoria, dia, semana, mes, ano, ano_mes_dia, descricao) 
                VALUES( $valor, $usuario,'$tipo', '$categoria','$dia', '$semana', '$mes', '$ano', '$data', '$descricao')";
        $true = $this->requisicao($sql);

        if($true):
            return true;
        else:
            return false;
        endif;
    } 
    
    public function delete(int $id, int $usuario){
        $id = clear($id);
        $usuario = clear($usuario);
        
        //Verificando
        $sql = "SELECT id_transacao from $this->table WHERE id_transacao = $id AND usuario = $usuario";
        $resultado = $this->total_rows($sql);

        if($resultado === 1):
            $sql = "DELETE from $this->table WHERE id_transacao = $id AND usuario = $usuario";

            try {
                  $this->requisicao($sql);
                  return true;
                } catch (Exception $e) {
                    return false;
                }
        endif;
    }   
    public function get_transacao(int $usuario, string $tipo){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);

        if(empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario ORDER BY ano_mes_dia DESC";
            $resultado =  $this->requisicao($sql);
        return $resultado;
        elseif(!empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE tipo = '$tipo' AND usuario = $usuario ORDER BY ano_mes_dia DESC";
            $resultado =  $this->requisicao($sql);
        return $resultado;
        endif;
    }
    public function get_transacoes_diarias(int $usuario, string $tipo, int $dia, int $mes, int $ano){
        $usario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $dia = $this->clear($dia);
        $mes = $this->clear($mes);
        $ano = $this->clear($ano);
        
        if(empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND dia = $dia AND mes = $mes AND ano = $ano";
            $resultado =  $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        elseif(!empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE tipo = '$tipo' AND usuario = $usuario AND dia = $dia AND mes = $mes AND ano = $ano";
            $resultado =  $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        endif;
    }
    public function get_transacoes_semanais(int $usuario, string $tipo, int $semana, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $semana = $this->clear($semana);
        $ano = $this->clear($ano);
        
        if(empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND semana = $semana AND ano = $ano";
            $resultado = $this->requisicao($sql);
            if($requisicao):
                return $resultado;
            else:
                return false;
            endif;
        elseif(!empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND semana = $semana AND ano = $ano AND tipo = '$tipo'";
            $resultado = $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        endif;
    }
    public function get_transacoes_mensais(int $usuario, string $tipo, int $mes, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $mes = $this->clear($mes);
        $ano = $this->clear($ano);
        
        if(empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND mes = $mes AND ano = $ano ORDER BY ano_mes_dia DESC";
            $resultado = $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        elseif(!empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND mes = $mes AND ano = $ano AND tipo = '$tipo' ORDER BY ano_mes_dia DESC";
            $resultado = $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        endif;
    }
    public function get_transacoes_anual(int $usuario, string $tipo, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $ano = $this->clear($ano);
        
        if(empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND ano = $ano";
            $resultado = $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        elseif(!empty($tipo)):
            $sql = "SELECT *FROM $this->table WHERE usuario = $usuario AND ano = $ano AND tipo = '$tipo'";
            $resultado = $this->requisicao($sql);
            if($resultado):
                return $resultado;
            else:
                return false;
            endif;
        endif;
    }

    //Pegar valor com distinct
    public function get_distinct(int $usuario, $column){
        if(!empty($column) AND !empty($usuario)):
            $sql = "SELECT distinct($column) FROM transacoes";
            $consulta = $this->requisicao($sql);

            return $consulta;
        endif;
    }

    public function balanco_diario(int $usuario, string $tipo, int $dia, int $mes, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $dia = $this->clear($dia);
        $mes = $this->clear($mes);
        $ano = $this->clear($ano);

        $balanco = [];

        $sql = "SELECT distinct(descricao) as d FROM $this->table WHERE usuario = $usuario AND dia = $dia AND mes = $mes AND ano = $ano AND tipo = '$tipo'";
        $resultado = $this->requisicao($sql);
        while($descricao = $resultado->fetchArray(SQLITE3_ASSOC)):
            $categoria[] = $descricao['d'];
        endwhile;

        if (!empty($categoria)) {
            $numero_categoira = count($categoria);
            for ($i=0; $i < $numero_categoira; $i++) { 
               $sql = "SELECT sum(valor) as valor FROM $this->table WHERE usuario = $usuario AND dia = $dia AND mes = $mes AND ano = $ano AND tipo = '$tipo' AND descricao = '$categoria[$i]'";
                $resultado = $this->requisicao($sql);
                $total = $resultado->fetchArray(SQLITE3_ASSOC);

                $balanco[] = [$categoria[$i] =>$total['valor']];
            }
            return $balanco;
        }else {
            return false;
        }
    }
    public function balanco_semanal( int $usuario, string $tipo, int $semana, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo); 
        $semana = $this->clear($semana);
        $ano = $this->clear($ano);
        
        $balanco = [];

        $sql = "SELECT distinct(descricao) as d FROM $this->table WHERE usuario = $usuario AND semana = $semana AND ano = $ano AND tipo = '$tipo'";
                $resultado = $this->requisicao($sql);
                while($descricao = $resultado->fetchArray(SQLITE3_ASSOC)):
                    $categoria[] = $descricao['d'];
                endwhile;

                if (!empty($categoria)) {
                    $numero_categoira = count($categoria);
                    for ($i=0; $i < $numero_categoira; $i++) { 
                        $sql = "SELECT sum(valor) as valor FROM $this->table WHERE usuario = $usuario AND semana = $semana AND ano = $ano AND tipo = '$tipo' AND descricao = '$categoria[$i]'";
                        $resultado = $this->requisicao($sql);
                        $total = $resultado->fetchArray(SQLITE3_ASSOC);

                        $balanco[] = [$categoria[$i] =>$total['valor']];
                    }
                    return $balanco;
                }else {
                    return false;
                }
    }
    public function balanco_mensal(int $usuario, string $tipo, int $mes, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $mes = $this->clear($mes);
        $ano = $this->clear($ano);

        $balanco = [];

        $sql = "SELECT distinct(descricao) as d FROM $this->table WHERE usuario = $usuario AND mes = $mes AND ano = $ano AND tipo = '$tipo'";
        $resultado = $this->requisicao($sql);
        while($descricao = $resultado->fetchArray(SQLITE3_ASSOC)):
            $categoria[] = $descricao['d'];
        endwhile;

        if (!empty($categoria)) {
            $numero_categoira = count($categoria);
            for ($i=0; $i < $numero_categoira; $i++) { 
                $sql = "SELECT sum(valor) as valor FROM $this->table WHERE usuario = $usuario AND mes = $mes AND ano = $ano AND tipo = '$tipo' AND descricao = '$categoria[$i]'";
                $resultado = $this->requisicao($sql);
                $total = $resultado->fetchArray(SQLITE3_ASSOC);

                $balanco[] = [$categoria[$i] =>$total['valor']];
            }
            return $balanco;
        }else {
            return false;
        }
    }
    public function balanco_anual(int $usuario, string $tipo, int $ano){
        $usuario = $this->clear($usuario);
        $tipo = $this->clear($tipo);
        $ano = $this->clear($ano);

        $balanco = [];

        $sql = "SELECT distinct(descricao) as d FROM $this->table WHERE usuario = $usuario AND  ano = $ano AND tipo = '$tipo'";
        $resultado = $this->requisicao($sql);
        while($descricao = $resultado->fetchArray(SQLITE3_ASSOC)):
            $categoria[] = $descricao['d'];
        endwhile;

        if (!empty($categoria)) {
            $numero_categoira = count($categoria);
            for ($i=0; $i < $numero_categoira; $i++) { 
                $sql = "SELECT sum(valor) as valor FROM $this->table WHERE usuario = $usuario AND ano = $ano AND tipo = '$tipo' AND descricao = '$categoria[$i]'";
                $resultado = $this->requisicao($sql);
                $total = $resultado->fetchArray(SQLITE3_ASSOC);

                $balanco[] = [$categoria[$i] =>$total['valor']];
            }
            return $balanco;
        }else {
            return false;
        }
    }

    //Buscar
    public function search(int $usuario, string $valor_pesquisa){
        $valor_pesquisa = $this->clear($valor_pesquisa);

        $sql = "SELECT *FROM transacoes WHERE usuario = $usuario AND (descricao LIKE '%$valor_pesquisa%' OR categoria = '$valor_pesquisa' OR tipo = '$valor_pesquisa') ORDER BY ano_mes_dia DESC";
        $consulta = $this->requisicao($sql);

        if($consulta):
            return $consulta;
        else:
            return false;
        endif;
    }
    public function search_valor(int $usuario, int|float $valor){
        $valor = $this->clear($valor);
        
        $sql = "SELECT *FROM transacoes WHERE usuario = $usuario AND valor = $valor ORDER BY ano_mes_dia DESC";
        $consulta = $this->requisicao($sql);

        if($consulta):
            return $consulta;
        else:
            return false;
        endif;
    }
    public function search_data(int $usuario, string $data_inicial, string $data_final){
        $data_inicial = $this->clear($data_inicial);
        $data_final = $this->clear($data_final);


        $sql = "SELECT *FROM transacoes WHERE usuario = $usuario AND (ano_mes_dia >= '$data_inicial' AND ano_mes_dia <= '$data_final') ORDER BY ano_mes_dia DESC";
        $consulta = $this->requisicao($sql);

        if($consulta):
            return $consulta;
        else:
            return false;
        endif;
    }
}
