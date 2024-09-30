<?php 
session_start();

require_once 'app/model/connexionBDD.php';
require_once 'app/controller/controller.php';

$page = 'trombinoscope';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch ($page) {
    case 'trombinoscope':
        require_once 'app/controller/trombi.controller.php';
        genererPageTrombinoscope();
        break;
    case 'erreur':
        genererPageErreur();
        break;
    default:
        genererPageErreur('Page non trouvée');
}
