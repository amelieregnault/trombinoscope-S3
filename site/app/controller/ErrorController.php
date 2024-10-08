<?php

namespace app\controller;


class ErrorController extends Controller
{
    /**
     * méthode permettant de générer une page d'erreur.
     * Il est possible d'indiquer un message en paramètre.
     *
     * @param string|null $message
     * @return void
     */
    public function genererPageErreur(?string $message = null)
    {

        $data = [
            'erreur' => $message ?? 'Erreur inconnue',
            'page_title' => 'Erreur',
            'view' => 'app/view/erreur.view.php',
            'layout' => 'app/view/common/layout-error.php',
        ];

        $this->genererPage($data);
    }
}