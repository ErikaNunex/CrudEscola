<?php

//solicitando ao composer que gerencie o carregamento automagico dos arquivos
include_once dirname(__DIR__).'/vendor/autoload.php';

session_start();

// include '../config/database.php';
include dirname(__DIR__).'/config/database.php';

// $rotas = require '../config/routes.php';
$rotas = require dirname(__DIR__).'/config/routes.php';

$url = $_SERVER['REQUEST_URI']; //pegando a url acessada pelo usuario
$rota = explode('?', $url)[0]; //separando a url, atraves do "?"

if (false === isset($rotas[$rota])) {
    echo "Erro 404";
    exit;
}

$controller = $rotas[$rota]['controller'];
$method = $rotas[$rota]['method'];

(new $controller)->$method();
