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
