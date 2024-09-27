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

$page_title = 'Trombinoscope - Nouvel étudiant';
if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
    unset($_SESSION['data']);
}

// 2 - Construire la vue et l'injecter dans la variable $content
ob_start();
include 'app/view/new-student.view.php';
$content = ob_get_clean();

// 3 - Génération du code HTML de la page à partir du layout
include 'app/view/common/layout.php';
