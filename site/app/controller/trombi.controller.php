<?php
require_once 'app/model/trombi.model.php';

function genererPageTrombinoscope()
{
    $db = getDB();

    $nbPages = getNbPages($db);
    $numPage = 1;
    if (isset($_GET['num']) && ctype_digit($_GET['num']) && $_GET['num'] > 0 && $_GET['num']<=$nbPages) {
        $numPage = $_GET['num'];
    }

    $data = [  
        'students' => getStudentsByPage($db, $numPage),
        'nbPages' => $nbPages,
        'numPage' => $numPage,
        'page_title' => 'Trombinoscope',
        'view' =>'app/view/trombi.view.php',
        'layout' => 'app/view/common/layout.php',
    ];

    genererPage($data);
}

function genererPageFiche() {

    if (empty($_GET['num']) || !ctype_digit($_GET['num']) || $_GET['num'] < 1) {
        $_SESSION['message'] = "L'identifiant n'est pas valide.";
        header('Location: index.php');
        exit;
    }
    $numStudent = intval($_GET['num']);
    
    $student = getStudent(getDB(), $numStudent);
    
    $pageTitle = 'Trombinoscope - ' . $student['firstname']  . ' ' . $student['lastname'];

    $data = [
        'student' => $student,
        'page_title' => $pageTitle,
        'view' => 'app/view/fiche.view.php',
        'layout' => 'app/view/common/layout.php',
    ];

    genererPage($data);
}
