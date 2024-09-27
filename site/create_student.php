<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'ROLE_ADMIN') {
    $_SESSION['message'] = "Vous n'avez pas les droits d'accès à cette page";
    header('Location: login.php');
    exit;
}

// Récupération des données
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

require_once 'app/model/connexionBDD.php';
require_once 'app/model/student.model.php';

if (isset($_POST['submit'])) {
    $dataToCheck = ['firstname', 'lastname', 'birthdate', 'group', 'description'];
    
    $complete = true;
    $_SESSION['data'] = [];
    foreach ($dataToCheck as $data) {
        if (empty($_POST[$data])) {
            $complete = false;
            $_SESSION['data'][$data] = "";
        } else {
            $_SESSION['data'][$data] = $_POST[$data];
        }
    }
}

if (!$complete) {
    $_SESSION['message'] = "Le formulaire n'est pas complet";
    header('Location: new_student.php');
    exit();
}

if ($_FILES['fileToUpload']['size'] > 0){
    include "upload.php";
    $filename = uploadFile();
}

try {
    $id = addStudent(getDB(), $_POST['firstname'], $_POST['lastname'],
        $_POST['birthdate'], $_POST['group'], $_POST['description'], $filename??null);
} catch (PDOException $e) {
    // $_SESSION['message'] = "Une erreur s'est produite lors de l'enregistrement";
    $_SESSION['message'] = $e->getMessage();
    header('Location: new_student.php');
    exit;
}

header('Location: fiche.php?num='.$id);
exit();


