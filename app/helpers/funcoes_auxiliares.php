<?php

//Conversão para float
function ToFloat($valor){
	$locale_info = localeconv();

	//Substituir o separador decimal pelo ponto
	$valor = str_replace(',', '.', $valor);

	return floatval($valor);
}

function FormatNumber($valor){
	$valor = number_format($valor, 2, ',', '.');
	return $valor;
}

function clear($input){
      $var = filter_var($input, FILTER_SANITIZE_STRING);
      $var = htmlspecialchars($var);
      return $var;
}

function FormatDateDivisor($valor){
	$var = str_replace('/', '-', $valor);
	return $var;
}

//Nome mês
function ObterNomeMes(int $mes, int $ano){
	$nome_mes = mktime(0, 0, 0, $mes, 1, $ano);
      $nome_mes = strftime('%B', $nome_mes);

      return $nome_mes;
}

function ObterNumeroMes(string $mes){
	$n_mes = date('m', strtotime($mes));
	return $n_mes;
}