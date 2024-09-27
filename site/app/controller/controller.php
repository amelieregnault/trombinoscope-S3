<?php

/**
 * fonction permettant de générer une page web à partir des données contenues dans le tableau data.
 * Le tableau data doit à minima contenir les champs 'view' et 'layout'.
 *
 * @param array $data : les données utilisées par la vue et la fonction
 * @return void
 */
function genererPage(array $data)
{
    // Récupération des messages d'erreur
    $message = null;
    if (!empty($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    extract($data);

    ob_start();
    require_once $view;
    $content = ob_get_clean();

    require_once $layout;
}

function genererPageErreur(?string $message = null)
{

    $data = [
        'erreur' => $message ?? 'Erreur inconnue',
        'page_title' => 'Erreur',
        'view' => 'app/view/erreur.view.php',
        'layout' => 'app/view/common/layout-error.php',
    ];

    genererPage($data);
}
