<?php

function getDB()
{
    $dsn = 'mysql:dbname=trombinoscope;host=mysql;charset=utf8';
    $username = 'root';
    $password = 'rootpassword';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $_SESSION['message'] = "La connexion à la base de données n'a pas pu être établie";
        header('Location: index.php?page=erreur');
        exit;
    }

    return $pdo;
}
