<?php

namespace app\controller;

class Controller
{

    /**
     * méthode permettant de générer une page web à partir des données contenues dans le tableau data.
     * Le tableau data doit à minima contenir les champs 'view' et 'layout'.
     *
     * @param array $data : les données utilisées par la vue et la fonction
     * @return void
     */
    protected function genererPage(array $data)
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


    
}
