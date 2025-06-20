<?php
session_start();

function validar(){
		if(isset($_SESSION['logado'])):
			if(!$_SESSION['logado']):
				require_once dirname(__DIR__, 1).'/Views/login.php';
			endif;
		endif;

	}
validar();