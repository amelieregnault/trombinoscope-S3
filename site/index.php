<?php
session_start();

require_once 'app/model/connexionBDD.php';
require_once 'app/controller/controller.php';

$router = new Router();
$router->addRoute('trombinoscope', new TrombiController, 'genererPageTrombinoscope');
$router->addRoute('erreur', new ErrorController, 'genererPageErreur');

$page = 'trombinoscope';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$router->callRoute($page);
