<?php
//Controller
require_once __DIR__.'/Controller.php';

class Controller_transacoes extends Controller{
    private $model;

    public function __construct(){
    	//Carregando a model
    	require_once dirname(__DIR__, 1).'/Models/Model_transacoes.php';
    	$this->model = new Transacoes();
        
        parent::__construct();
    }
	public function index(){
        
		//$this->registrar_transacao();
	}

	public function registrar_transacao(){
        //Eliminar transacao
        if(isset($_POST['btn-deletar'])):
            $this->deletar_transacao();
        endif;

        //Cadastrar transacoes
        if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['btn-registrar-transacao'])) {
            $descricao = $_POST['input-descricao'];
            $categoria = $_POST['select-categoria'];
            $valor = ToFloat($_POST['input-valor']);
            $tipo = $_POST['input-tipo'];
            $data = $_POST['input-data'];
            
            if(empty($descricao) || empty($categoria) || empty($valor) || empty($tipo) || empty($data)):
                //die($sms = "Preencha todos os campos");
            else:
                $this->model->realizar_transacao($descricao, $categoria, $tipo, $data, $valor, $this->user);
                //die($sms = "Sucesso");
            endif;
        }
        
         //Código para trocar  alterara o mês e ano 
        if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['btn-next']) || isset($_POST['btn-back']))){
            $data = $_POST['input-periodo']?? false;

            if($data != false):
                list($mes, $ano) = explode("-", $data);

                //formatando o mês
                $timestamp = strtotime('1-'.$data);
                $mes = date('n', $timestamp);

                $true_data = checkdate(1, $mes, $ano);
            else:
                $true_data = false;
            endif;

            if($true_data){
                $ultimo_mes = $mes == 12;
                $primeiro_mes = $mes == 1;
                if(isset($_POST['btn-next'])):
                    if($ultimo_mes):
                        $ano = $ano + 1;
                        $mes = 1;
                    else:
                        $mes = $mes + 1;
                    endif;
                elseif(isset($_POST['btn-back'])):
                    if($primeiro_mes):
                        $ano = $ano - 1;
                        $mes = 12;
                    else:
                        $mes = $mes - 1;
                    endif;
                endif;
            }else{
                $sms = "Insira uma data inválida";
            }
        }else{
            $mes = date('m');
            $ano = date('Y');
        }

        //formatando o mês
        $nome_mes = ObterNomeMes(mes: $mes, ano: $ano);
        
        $dados_mensais = $this->dados_transacoes_mensaiss($mes, $ano);
        $transacoes = $dados_mensais['transacoes'];
        $receitas = $dados_mensais['receitas'];
        $despesas = $dados_mensais['despesas'];
        $saldo = $dados_mensais['saldo'];

        //Carregar a view
        require_once dirname(__DIR__, 1).'/Views/adicionar_transacao.php';         
    }
    
    public function ver_transacoes(){
        
        $dados = $this->get_all();
        $categoria = $this->model->get_distinct(usuario: $this->user, column: 'categoria');
        $descricao = $this->model->get_distinct(usuario: $this->user, column: 'descricao');

        //Carregar a view
        require_once dirname(__DIR__, 1).'/Views/transacoes.php';
    }

    private function deletar_transacao(){
            $id = clear($_POST['input-id']);
            $deletar = $this->model->delete(usuario: $this->user, id: $id);

            if($deletar):
                $msg = "Sucesso";
            else:
                $msg = "Erro ao deletar!";
            endif;
    }

    public function filtrar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-filtrar'])) {
            $_POST['input-filtro'] = $_POST['input-filtro']?? 'data';
            $filtro = $_POST['input-filtro'];
            
            switch ($filtro) {
                case 'data':
                    if(!empty($_POST['input-data-inicial']) OR !empty($_POST['input-data-final'])):
                        //Sanitanização
                        $data_inicial = clear($_POST['input-data-inicial']);
                        $data_final = clear($_POST['input-data-final']);
                        //Formatando os separadores
                        $data_inicial = FormatDateDivisor($data_inicial);
                        $data_final = FormatDateDivisor($data_final);
 
                        $dados = $this->model->search_data(usuario: $this->user, data_inicial: "$data_inicial", data_final: "$data_final");
                    else:
                        $this->ver_transacoes();
                    endif;
                 
                    break;
                
                case 'valor':
                    if(!empty($_POST['input-valor'])):
                        $valor = clear($_POST['input-valor']); 
                        $valor = intval($valor);

                        $dados = $this->model->search_valor(usuario: $this->user, valor: $valor);
                    else:
                        $this->ver_transacoes();
                    endif;
                    
                    break;

                case 'tipo':
                    if(!empty($_POST['input-tipo'])):
                        $tipo = clear($_POST['input-tipo']);
                        $dados = $this->model->search(usuario: $this->user, valor_pesquisa: "$tipo");
                    else:
                        $this->ver_transacoes();    
                    endif;

                    break;

                case 'descricao':
                    $descricao_s = clear($_POST['select-descricao']);
                    $dados = $this->model->search(usuario: $this->user, valor_pesquisa: "$descricao_s");
                    break;

                case 'categoria':
                    $categoria_s = clear($_POST['select-categoria']);
                    $dados = $this->model->search(usuario: $this->user, valor_pesquisa: "$categoria_s");
                    break;

                default:
                    break;
            }

        }elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-todos'])){
            $dados = $this->get_all();
        }/*elseif($_SERVER['REQUEST_METHOD']){
            $dados = $this->get_all();
        }*/else{
            $dados = $this->get_all();
        }

        $categoria = $this->model->get_distinct(usuario: $this->user, column: 'categoria');
        $descricao = $this->model->get_distinct(usuario: $this->user, column: 'descricao');
        
        //Carregar a view
        require_once dirname(__DIR__, 1).'/Views/transacoes.php';
    }
    
    public function get_all(){
        $resultado = $this->model->get_transacao($this->user, '');
        return $resultado;
    }

    public function dados_transacoes_mensaiss( $mes, $ano){
         
        $transacoes = $this->model->get_transacoes_mensais($this->user, '', $mes, $ano);
        //$true_dados = $transacoes->fetchArray(SQLITE3_ASSOC);
        
        $receitas = $this->model->balanco_mensal($this->user, 'entrada', $mes, $ano);
        $despesas = $this->model->balanco_mensal($this->user, 'saida', $mes, $ano);
        $valores = array("receitas"=>$receitas, "despesas"=>$despesas);

        $total = $this->balanco_valores_totais($valores);
        $receitas = $total['receitas'];
        $despesas = $total['despesas'];
        $saldo = $receitas - $despesas;
        
        $receitas = FormatNumber($receitas);
        $despesas = FormatNumber($despesas);
        $saldo = FormatNumber($saldo);

        $dados_mensais = array('transacoes'=> $transacoes, 'receitas'=> $receitas, 'despesas'=> $despesas, 'saldo'=> $saldo );

        return $dados_mensais;
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
}