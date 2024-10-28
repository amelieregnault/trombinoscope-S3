<?php

namespace app\model;

use Exception;

/**
 * La méthode utilisée n'est pas optimale, mais ce n'est pas grave
 * car il n'y a que 100 étudiants dans la base de données.
 */
class Trombinoscope
{

    // Attributs
    private array $students;
    private int $nbStudentPerPage;

    //Méthodes
    public function __construct()
    {
        $this->nbStudentPerPage = 16;
        $this->students = [];
        $students = $this->getAllStudents();
        foreach ($students as $studentData) {
            $student = new Student();
            $student->hydrate($studentData);
            $this->addStudent($student);
        }
    }

    /**
     * Retourne l'étudiant correspondant au numéro passé en paramètre
     *
     * @param integer $numStudent
     * @return Student
     */
    public function getStudent(int $numStudent): Student
    {
        if (!key_exists($numStudent, $this->students)) {
            throw new Exception("L'étudiant n'existe pas");
        }
        return $this->students[$numStudent];
    }


    /**
     * Retourne l'ensemble des étudiants présents dans la base de données.
     *
     * @return array
     */
    private function getAllStudents(): array
    {
        $pdo = Database::getConnexion();
        $sql = "SELECT * FROM students";
        $stmt = $pdo->query($sql);
        $students = $stmt->fetchAll();
        return $students;
    }

    /**
     * Calcule le nombre de pages à créer pour le trombinoscope.
     *
     * @return integer
     */
    public function getNbPages(): int
    {
        $nbStudents = count($this->students);
        return ceil($nbStudents / $this->nbStudentPerPage);
    }

    /**
     * Récupère seulement les étudiants correspondants à la page demandée
     *
     * @param integer $numPage
     * @return array
     */
    function getStudentsByPage(int $numPage): array
    {
        $offset = ($numPage - 1) * $this->nbStudentPerPage;
        $students = array_slice($this->students, $offset, $this->nbStudentPerPage,true);
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

    /**
     * Get the value of nbStudentPerPage
     *
     * @return int
     */
    public function getNbStudentPerPage(): int
    {
        return $this->nbStudentPerPage;
    }
}
