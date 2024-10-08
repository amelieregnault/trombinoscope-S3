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
    case 'fiche':
        require_once 'app/controller/trombi.controller.php';
        genererPageFiche();
        break;
    case 'login':
        require_once 'app/controller/admin.controller.php';
        genererPageLogin();
        break;
    case 'submit-login':
        require_once 'app/controller/admin.controller.php';
        submitLogin();
        break;
    case 'new-student':
        require_once 'app/controller/student.controller.php';
        genererPageNouvelEtudiant();
        break;
    case 'create-student':
        require_once 'app/controller/student.controller.php';
        createStudent();
        break;
    case 'erreur':
        genererPageErreur();
        break;
    default:
        genererPageErreur('Page non trouvée');
}
