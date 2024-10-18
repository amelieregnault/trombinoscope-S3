<?php

namespace app\model;

/**
 * La méthode utilisée n'est pas optimale, mais ce n'est pas grave
 * car il n'y a que 100 étudiants dans la base de données.
 */
class Trombinoscope extends Model
{

    // Attributs
    private array $students;

    //Méthodes
    public function __construct()
    {
        $this->students = [];
        $students = $this->getAllStudents();
        foreach ($students as $studentData) {
            $student = new Student();
            $student->hydrate($studentData);
            $this->addStudent($student);
        }
    }

    public function getStudent(int $numStudent): Student
    {
        if (!key_exists($numStudent, $this->students)){
            $this->redirectToPageWithError('index.php', "L'étudiant n'existe pas");
        }
        return $this->students[$numStudent];
    }


    private function getAllStudents(): array
    {
        $pdo = Database::getConnexion();
        $sql = "SELECT * FROM students";
        $stmt = $pdo->query($sql);
        $students = $stmt->fetchAll();
        return $students;
    }


    /**
     * Get the value of students
     *
     * @return array
     */
    public function getStudents(): array
    {
        return $this->students;
    }

    public function addStudent(Student $student)
    {
        $this->students[$student->getId()] = $student;
    }
}

// function getStudent(PDO $pdo, int $numStudent): array
// {
//     $sql = "SELECT * FROM students WHERE id=:id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':id', $numStudent, PDO::PARAM_INT);
//     $stmt->execute();

//     if (!$student = $stmt->fetch()) {
//         $_SESSION['message'] = "L'étudiant n'existe pas !";
//         header('Location: index.php');
//         exit;
//     }
//     return $student;
// }

// function getAllStudents(PDO $pdo) 
// {
//     $sql = "SELECT * FROM students";
//     $stmt = $pdo->query($sql);
//     $students = $stmt->fetchAll();
//     return $students;
// }

// function getStudentsByPage(PDO $pdo, int $numPage): array
// {
//     $nbStudentsPerPage = 16;
//     $offset = ($numPage - 1) * $nbStudentsPerPage;
//     $sql = "SELECT * FROM students LIMIT " . $nbStudentsPerPage .  " OFFSET " . $offset;
//     $stmt = $pdo->query($sql);
//     $students = $stmt->fetchAll();
//     return $students;
// }

// function getNbPages(PDO $pdo): int
// {
//     $nbStudentsPerPage = 16;
//     $sql = "SELECT count(*) FROM students";
//     $stmt = $pdo->query($sql);
//     $nbStudents = $stmt->fetchColumn();
//     return ceil($nbStudents / $nbStudentsPerPage);
// }