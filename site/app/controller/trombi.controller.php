<?php
require_once 'app/controller/controller.php';
require_once 'app/model/trombi.model.php';

function genererPageTrombinoscope()
{
    $db = getDB();

    $nbPages = getNbPages($db);
    $numPage = 1;
    if (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 0 && $_GET['page']<=$nbPages) {
        $numPage = $_GET['page'];
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
