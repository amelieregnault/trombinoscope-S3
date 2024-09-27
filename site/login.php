<?php

session_start();

// Récupération des données
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$page_title = "Trombinoscope - login";

// Chargement de la vue
ob_start();
include 'app/view/login.view.php';
$content = ob_get_clean();

// Génération de la page HTML à partir du Layout
include 'app/view/common/layout.php';

