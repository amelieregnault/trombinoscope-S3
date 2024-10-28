<?php

use app\controller\AdminController;
use app\controller\ErrorController;
use app\controller\Router;
use app\controller\StudentController;
use app\controller\TrombiController;

session_start();

require_once 'autoload.php';

$router = new Router();
$trombiController = new TrombiController();
$adminController = new AdminController();
$studentController = new StudentController();
$router->addRoute('trombinoscope', $trombiController, 'genererPageTrombinoscope');
$router->addRoute('fiche', $trombiController, 'genererPageFiche');
$router->addRoute('login', $adminController, 'genererPageLogin');
$router->addRoute('submit-login', $adminController, 'submitLogin');
$router->addRoute('new-student', $studentController, 'genererPageNewStudent');
$router->addRoute('create-student', $studentController, 'createStudent');
$router->addRoute('erreur', new ErrorController(), 'genererPageErreur');

$page = 'trombinoscope';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$router->callRoute($page);
