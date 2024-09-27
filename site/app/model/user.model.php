<?php

function authentification(PDO $pdo, string $login, string $password): string
{
    $sql = "SELECT * FROM user WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $result = $stmt->fetch();
    if (!$result || !password_verify($password, $result['mdp'])) {
        throw new Exception("Erreur de login/mot de passe");
    }
    return $result['role'];
}
