<?php

namespace app\controller;

use app\model\Trombinoscope;
use Exception;

class TrombiController extends Controller
{

    /**
     * méthode permettant de générer la page HTML correspondant aux trombinoscopes
     *
     * @return void
     */ 
    public function genererPageTrombinoscope()
    {
        $trombinoscope = new Trombinoscope();

        $nbPages = $trombinoscope->getNbPages();
        $numPage = $this->getNumPage($nbPages);
        $data = [
            'students' => $trombinoscope->getStudentsByPage($numPage),
            'nbPages' => $nbPages,
            'numPage' => $numPage,
            'page_title' => 'Trombinoscope',
            'view' => 'app/view/trombi.view.php',
            'layout' => 'app/view/common/layout.php',
        ];

        $this->genererPage($data);
    }


    /**
     * Contrôleur pour générer une fiche d'étudiant accessible depuis le trombinoscope
     *
     * @return void
     */
    public function genererPageFiche()
    {
        if (!isset($_GET['num']) || !ctype_digit($_GET['num']) || $_GET['num'] <= 0) {
            $this->redirectToPageWithError('index.php', "Numéro d'étudiant invalide");
        }

        $trombinoscope = new Trombinoscope();
        try {
            $student = $trombinoscope->getStudent($_GET['num']);
        } catch (Exception $e) {
            $this->redirectToPageWithError('index.php', $e->getMessage());
        }

        $data = [
            'student' => $student,
            'page_title' => "Fiche de " . $student->getPrenom() . " " . $student->getNom(),
            'view' => 'app/view/fiche.view.php',
            'layout' => 'app/view/common/layout.php',
        ];

        $this->genererPage($data);
    }


    /**
     * fonction récupérant le numéro de la page à afficher.
     * Si le numéro récupérer dépasse le nombre de page, 
     * on renvoie le numéro de la dernière page
     * Si le numéro n'est pas valide d'une autre manière, 
     * on renvoie la numéro de la première page
     * Sinon, on renvoie le numéro préciser dans l'url
     * 
     * @param integer $nbPages
     * @return int
     */
    private function getNumPage (int $nbPages): int 
    {
        if (!isset($_GET['num']) || !ctype_digit($_GET['num']) || $_GET['num'] <= 0) {
            return 1;
        }
        if ($_GET['num'] > $nbPages) {
            return $nbPages;
        } 
        return $_GET['num'];
    }
}
