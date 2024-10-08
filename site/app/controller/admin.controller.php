<?php

require_once 'app/model/user.model.php';

function genererPageLogin() 
{
    $data = [
        'page_title' => "Trombinoscope - login",
        'view' => 'app/view/login.view.php',
        'layout' => 'app/view/common/layout.php',
    ];

    genererPage($data);

}

function submitLogin() {
    if (empty($_POST['login']) || empty($_POST['password'])) {
        $_SESSION['message'] = "Erreur de login/mot de passe";
        header('Location: index.php?page=login');
        exit;
    }
    
    try {
        $_SESSION['role'] = authentification(getDB(), $_POST['login'], $_POST['password']);
        header('Location: index.php?page=new-student');
        exit;
    } catch (\Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header('Location: index.php?page=login');
        exit;
    }
}