<?php

function addStudent(
    PDO $pdo,
    string $firstname,
    string $lastname,
    string $birthdate,
    string $group,
    string $description,
    string $photo = null,
) 
{
    try {
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
