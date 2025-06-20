<?php
//Controller
require_once __DIR__.'/Controller.php';

/**
  Classe responsavél por realizar o balanco dos valores
 **/
class Controller_balanco extends Controller{
    private $model;
    
    function __construct()
    {
        parent::__construct();
        //Carregar a model
        require_once dirname(__DIR__, 1).'/Models/Model_transacoes.php';
        $this->model = new Transacoes();
    }

    public function index(){
        $this->balanco_periodo();
    }
    
    public function balanco_periodo(){
        //Definindo array periíodo
        $periodos = ['diario', 'mensal', 'anual', 'semanal'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // code...
            $periodo = $_POST['input-periodo-balanco']?? $periodos[0];

            //Lógica para troca de periódo
            if( isset($_POST['btn-back-periodo']) || isset($_POST['btn-next-periodo'])):
                if(isset($_POST['btn-next-periodo'])):
                    if($periodo == $periodos[0]):
                        $periodo = $periodos[1];
                    elseif($periodo == $periodos[1]):
                        $periodo = $periodos[2];
                    elseif($periodo == $periodos[2]):
                        $periodo = $periodos[0];
                    endif;
                endif;

                if(isset($_POST['btn-back-periodo'])):
                    if($periodo == $periodos[2]):
                        $periodo = $periodos[1];
                    elseif($periodo == $periodos[1]):
                        $periodo = $periodos[0];
                    elseif($periodo == $periodos[0]):
                        $periodo = $periodos[2];
                    endif;
                endif;
            else:
                $periodo = $_POST['input-periodo-balanco'];
            endif;
        }else{
            $periodo = $periodos[0];
        }
        
        switch ($periodo) {
            case 'diario':
                if(isset($_POST['btn-realizar-balanco'])):
                    $data = $_POST['input-data-balanco-diario'];
                else:
                    $data = date('Y-m-d');
                endif;

                list($ano, $mes, $dia) = explode("-", $data);
                
                $dia = clear(intval($dia));
                $mes = clear(intval($mes));
                $ano = clear(intval($ano));
                
                $data_count = "$ano-$mes-$dia";

                $dados = $this->balanco_diario(dia: $dia, mes: $mes, ano: $ano);

                break;

            case 'mensal':
                
                $data = $_POST['input-data-balanco-mensal'] ?? date('m-Y');
                list($mes, $ano) = explode('-', $data);

                $true_data = checkdate($mes, 1, $ano);

                if($true_data):
                    $mes = clear(intval($mes));
                    $ano = clear(intval($ano));

                    //Lógica para troca do mês
                    if( isset($_POST['btn-next-month']) || isset($_POST['btn-back-month']) ){
                        $ultimo_mes = $mes == 12;
                        $primeiro_mes = $mes == 1;
                        if(isset($_POST['btn-next-month'])):
                            if($ultimo_mes):
                                $ano = $ano + 1;
                                $mes = 1;
                            else:
                                $mes = $mes + 1;
                            endif;
                        elseif(isset($_POST['btn-back-month'])):
                            if($primeiro_mes):
                                $ano = $ano - 1;
                                $mes = 12;
                            else:
                                $mes = $mes - 1;
                            endif;
                        endif;
                    }
                    
                    $data_count = "$mes-$ano";

                    $dados = $this->balanco_mensal(mes: $mes, ano: $ano);

                endif;

                break;

            case 'anual':
                $data = $_POST['input-data-balanco-anual']?? date('Y');
                $true_data = checkdate(1, 1, $data);
                if($true_data):
                    $ano = clear(intval($data));

                    //Lógica para troca de ano
                    if(isset($_POST['btn-next-year'])):
                        $ano++;
                    elseif(isset($_POST['btn-back-year'])):
                        $ano--;
                    endif;
                    
                    $data_count = $ano;
                    $dados = $this->balanco_anual($ano);
                    
                endif;

                break;
        }
        
        $total = $this->balanco_valores_totais($dados);        
        $total_receitas = FormatNumber($total['receitas']);
        $total_despesas = FormatNumber($total['despesas']);
        $saldo = FormatNumber($total['receitas'] - $total['despesas']);
        
        //Número de entradas e saidas
        //Contabilizar entradas e saídas
        $entradas = $this->count_n_movimentos(tipo: 'entrada', periodo: "$periodo", data: $data_count);
        $saidas = $this->count_n_movimentos(tipo: 'saida', periodo: "$periodo", data: $data_count);
        $total_movimentos = $entradas + $saidas;

        //Variavél percentual para o gráfico
        if( $total['receitas'] != 0):
            $percentagem_receitas = ($total['receitas'] /($total['receitas'] + $total['despesas']) * 100);
        else:
            $percentagem_receitas = 0;
        endif;
        
        $dados_movimentos = $dados;        
        require_once dirname(__DIR__, 1).'/Views/balanco.php';
    }

    public function balanco_diario(int $dia, int $mes, int $ano){
        $dia = clear($dia);
        $mes = clear($mes);
        $ano = clear($ano);

        $receitas = $this->model->balanco_diario(usuario: $this->user, dia: $dia, ano: $ano, mes: $mes, tipo: 'entrada');
        $despesas = $this->model->balanco_diario(usuario: $this->user, dia: $dia, ano: $ano, mes: $mes, tipo: 'saida');
        $dados = array("receitas"=>$receitas, "despesas"=>$despesas);
        
        return $dados;
    }
    public function balanco_semanal(int $semana, int $ano){
        $semana = clear($semana);
        $ano = clear($ano);

        $receitas = $this->model->balanco_semanal(usuario: $this->user, semana: $semana, ano: $ano, tipo: 'entrada');
        $despesas = $this->model->balanco_semanal(usuario: $this->user, semana: $semana, ano: $ano, tipo: 'saida');
        $dados = array("receitas"=>$receitas, "despesas"=>$despesas);

        return $dados;
    }
    public function balanco_mensal(int $mes, int $ano){
        $mes = clear($mes);
        $ano = clear($ano);

        $receitas = $this->model->balanco_mensal(usuario: $this->user, tipo: 'entrada', mes: $mes, ano: $ano);
        $despesas = $this->model->balanco_mensal(usuario: $this->user, tipo: 'saida', mes: $mes, ano: $ano);
        $dados = array("receitas"=>$receitas, "despesas"=>$despesas);

        return $dados;
    }
    public function balanco_anual(int $ano){
        $ano = clear($ano);

        $receitas = $this->model->balanco_anual(usuario: $this->user, tipo: 'entrada', ano: $ano);
        $despesas = $this->model->balanco_anual(usuario: $this->user, tipo: 'saida', ano: $ano);

        $dados = array("receitas"=>$receitas, "despesas"=>$despesas);

        return $dados;
    }

     public function balanco_valores_totais($balanco){
        if(is_array($balanco)){
            //total receitas
            if(is_array($balanco['receitas'])):
                $contador = count($balanco['receitas']);
                $i= 0;
                $total_receitas = 0;
                while($i < $contador):
                    foreach ($balanco['receitas'][$i] as $key => $value) {
                        $total_receitas = $total_receitas + $value;   
                    }
                $i++;
                endwhile;
            elseif($balanco['receitas'] == false):
                $total_receitas = 0;
            endif;

            //total despesas
            if(is_array($balanco['despesas'])):
                $contador = count($balanco['despesas']);
                $i= 0;
                $total_despesas = 0;
                while($i < $contador):
                    foreach ($balanco['despesas'][$i] as $key => $value) {
                        $total_despesas = $total_despesas + $value;   
                    }
                    $i++;
                endwhile;
            elseif($balanco['despesas'] == false):
                $total_despesas = 0;
            endif;

            $total = array("receitas"=>$total_receitas, "despesas"=>$total_despesas);
            return $total;
        }else{
            return $balanco;
        }

    }

    public function count_n_movimentos(string $tipo, string $periodo, $data){
        $data = clear($data);

          switch ($periodo) {
              case 'diario':
                  list($ano, $mes, $dia) = explode('-', $data);
                  $ano = intval($ano);
                  $mes = intval($mes);
                  $dia = intval($dia);

                  $transacoes = $this->model->get_transacoes_diarias(usuario: $this->user, tipo: "$tipo", dia: $dia, mes: $mes, ano: $ano);
                  break;
              case 'mensal':
                  list($mes, $ano) = explode('-', $data);
                  $ano = intval($ano);
                  $mes = intval($mes);

                  $transacoes = $this->model->get_transacoes_mensais(usuario: $this->user, tipo: "$tipo", mes: $mes, ano: $ano);
                  break;
               case 'anual':
                  $ano = intval($data);
                  $transacoes = $this->model->get_transacoes_anual(usuario: $this->user, tipo: "$tipo", ano: $ano);
                  break;
          }
        
        $n_movimentos = 0;
        while ($dados = $transacoes->fetchArray(SQLITE3_ASSOC)) {
                $n_movimentos++;
        }

        return $n_movimentos;
    }
    
}



