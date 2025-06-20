<?php
//Includes
require_once dirname(__DIR__).'/Models/model_usuario.php';
require_once __DIR__.'/Controller.php';

class Controller_user extends Controller{
	private $model;
	private $usuario;
	private $senha;

	public function __construct()
	{
		parent::__construct();
		$this->model = new Model_usuario();
	}

	public function gerarPdf(){

		//Carrregando a biblioteca TCDPF
		require_once dirname(__DIR__, 1).'/helpers/gerarPdf.php';
		
		//Carregando a model
		require_once dirname(__DIR__, 1).'/Models/Model_transacoes.php';
        $transacoes = new Transacoes();
        $historico = $transacoes->get_transacao(usuario: $this->user, tipo: '');
		ob_start();
		gerarPdf($historico);

	}

	function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['btn-login']))
        {
        	$this->usuario = $_POST['input-user'];
        	$this->senha = $_POST['input-password'];
        	//Validados os dados
        if(empty($this->usuario) || empty($this->senha)):
        	echo "Preencha todos os campos";
        else:
        	$this->model->usuario = $this->usuario;
		    $this->model->password = $this->senha;
            
            $dados = $this->model->login();

            if($dados != false && !empty($dados)):
            	$_SESSION['logado'] = true;
            	$_SESSION['usuario'] = $dados;
           
            	header('Location: index.php?balanco');
            else:
            	require_once dirname(__DIR__, 1).'/Views/login.php';
            endif;
        endif;
        }
        else{
        	require_once dirname(__DIR__, 1).'/Views/login.php';
        }
	}

    function logout(){
		unset($_SESSION['logado']);
		unset($_SESSION['usuario']);
		session_destroy();

		require_once dirname(__DIR__,1).'/Views/login.php';
	}

}
