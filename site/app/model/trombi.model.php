<?php

function getStudent(PDO $pdo, int $numStudent): array
{
    $sql = "SELECT * FROM students WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $numStudent, PDO::PARAM_INT);
    $stmt->execute();

    if (!$student = $stmt->fetch()) {
        $_SESSION['message'] = "L'étudiant n'existe pas !";
        header('Location: trombinoscope.php');
        exit;
    }
    return $student;
}

function getAllStudents(PDO $pdo) 
{
    $sql = "SELECT * FROM students";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
    return $students;
}

function getStudentsByPage(PDO $pdo, int $numPage): array
{
    $nbStudentsPerPage = 16;
    $offset = ($numPage - 1) * $nbStudentsPerPage;
    $sql = "SELECT * FROM students LIMIT " . $nbStudentsPerPage .  " OFFSET " . $offset;
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
    return $students;
}

function getNbPages(PDO $pdo): int
{
    $nbStudentsPerPage = 16;
    $sql = "SELECT count(*) FROM students";
    $stmt = $pdo->query($sql);
    $nbStudents = $stmt->fetchColumn();
    return ceil($nbStudents / $nbStudentsPerPage);
}