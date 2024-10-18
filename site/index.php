<?php

use app\controller\ErrorController;
use app\controller\Router;
use app\controller\TrombiController;

session_start();

require_once 'autoload.php';

$router = new Router();
$trombiController = new TrombiController();
$router->addRoute('trombinoscope', $trombiController, 'genererPageTrombinoscope');
$router->addRoute('fiche', $trombiController, 'genererPageFiche');
$router->addRoute('erreur', new ErrorController(), 'genererPageErreur');

$page = 'trombinoscope';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$router->callRoute($page);
