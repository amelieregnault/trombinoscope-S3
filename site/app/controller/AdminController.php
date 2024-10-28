<?php

namespace app\controller;

use app\model\User;

class AdminController extends Controller
{
    public function genererPageLogin()
    {
        $data = [
            'page_title' => "Trombinoscope - login",
            'view' => 'app/view/login.view.php',
            'layout' => 'app/view/common/layout.php',
        ];

        $this->genererPage($data);
    }

    public function submitLogin()
    {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            $this->redirectToPageWithError('index.php?page=login', "Erreur de login/mot de passe");
        }

        $user = new User();

        try {
            $user->authenticate($_POST['login'], $_POST['password']);
        } catch (\Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            header('Location: index.php?page=login');
            exit;
        }

        header('Location: index.php?page=new-student');
        exit;
    }
}

