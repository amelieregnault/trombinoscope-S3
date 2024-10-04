<?php

/**
 * Classe pour gérer la connexion à la base de données.
 * C'est une classe suivant le design pattern "singleton".
 * Utiliser la méthode de classe getConnexion pour obtenir une connexion 
 * à la base de données.
 */
class Database
{
    private static ?PDO $pdo = null;

    private static function connexion() {
        $dsn = 'mysql:dbname=trombinoscope;host=mysql;charset=utf8';
        $username = 'root';
        $password = 'rootpassword';

        try {
            self::$pdo = new PDO($dsn, $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['message'] = "La connexion à la base de données n'a pas pu être établie";
            header('Location: index.php?page=erreur');
            exit;
        }
    }

    public static function getConnexion(): PDO
    {
        return self::$pdo??self::connexion();
    }
}
