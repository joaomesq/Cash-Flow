<?php
//index

//Includes
require_once __DIR__.'/app/helpers/sessao.php';
require_once __DIR__.'/app/helpers/funcoes_auxiliares.php';
require_once __DIR__.'/core/route.php';

//Obatendo a rota
$url = $_SERVER['QUERY_STRING'];
$method = $_SERVER['REQUEST_METHOD'];
  
Route::router($url, $method);