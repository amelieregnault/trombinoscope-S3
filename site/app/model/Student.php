<?php

namespace app\model;

use PDOException;

class Student
{
    private int $id;
    private string $prenom;
    private string $nom;
    private string $groupe;
    private string $dateNaissance;
    private string $description;
    private ?string $photo;

    // Méthode    

    public function hasPhoto(): bool
    {
        return !empty($this->photo);
    }

    public function hydrate(array $data)
    {
        $this->id = $data['id'];
        $this->prenom = $data['firstname'];
        $this->nom = $data['lastname'];
        $this->dateNaissance = $data['birthdate'];
        $this->groupe = $data['group'];
        $this->description = $data['description'];
        $this->photo = $data['photo'] ?? null;
    }


    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of prenom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param string $prenom
     *
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of groupe
     *
     * @return string
     */
    public function getGroupe(): string
    {
        return $this->groupe;
    }

    /**
     * Set the value of groupe
     *
     * @param string $groupe
     *
     * @return self
     */
    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get the value of dateNaissance
     *
     * @return string
     */
    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    /**
     * Set the value of dateNaissance
     *
     * @param string $dateNaissance
     *
     * @return self
     */
    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param string $photo
     *
     * @return self
     */
    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public static function create(
        string $firstname,
        string $lastname,
        string $birthdate,
        string $group,
        string $description,
        string $photo = null,
    ): int {
        try {
            $pdo = Database::getConnexion();
            $sql = "INSERT INTO students " . 
             "(`firstname`, `lastname`, `birthdate`, `group`, `photo`, `description`)  VALUES " . 
             "(:firstname, :lastname, :birthdate, :group, :photo, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':group', $group);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
