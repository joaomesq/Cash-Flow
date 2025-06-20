<?php

class Controller{
	protected $user;

	function __construct(){
		if(isset($_SESSION['usuario'])):
			$this->setUser($_SESSION['usuario']['id_usuario']?? 'Visitante');
		else:
			require_once dirname(__DIR__, 1).'/helpers/sessao.php';
		endif;
	}

	public function setUser(int $user){
		$this->user = $user;
	}
	public function getUser(){
		return $this->user;
	}

	public function index()
	{
		require_once dirname(__DIR__, 1).'/Views/login.php';
	}
}