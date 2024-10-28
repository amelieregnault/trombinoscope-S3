<?php

namespace app\model;

use Exception;

class User extends Model
{
    private string $role;

    public function __construct()
    {
        if (isset($_SESSION['role'])) {
            $this->role = $_SESSION['role'];
        }
    }

    /**
     * Essaie de faire l'authentification d'un utilisateur à partir du login et mot de passe transmis
     *
     * @param string $login
     * @param string $password
     * @return void
     */
    public function authenticate(string $login, string $password)
    {
        $pdo = Database::getConnexion();
        $sql = "SELECT * FROM user WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$result || !password_verify($password, $result['mdp'])) {
            throw new Exception("Erreur de login/mot de passe");
        }
        $this->role = $result['role'];
        $_SESSION['role'] = $result['role'];
    }

    /**
     * Permet de savoir si un utilisateur est administrateur
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role && $this->role == 'ROLE_ADMIN';
    }
}
