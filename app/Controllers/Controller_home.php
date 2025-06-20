<?php

/**
 * 
 */
class Controller_home{
	
	function __construct()
	{
		// code...
		 $this->user = 1;
        //Carregar a model
        require_once dirname(__DIR__, 1).'/Models/Model_transacoes.php';
        $this->model = new Transacoes();
	}

	public function index(){
		require_once dirname(__DIR__, 1).'/Views/welcome.php';
	}
}
