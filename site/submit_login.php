<?php
session_start();

require_once 'app/model/connexionBDD.php';
require_once 'app/model/user.model.php';

if (empty($_POST['login']) || empty($_POST['password'])) {
    $_SESSION['message'] = "Erreur de login/mot de passe";
    header('Location: login.php');
    exit;
}

try {
    $_SESSION['role'] = authentification(getDB(), $_POST['login'], $_POST['password']);
    header('Location: new_student.php');
    exit;
} catch (\Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    header('Location: login.php');
    exit;
}