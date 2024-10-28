<?php

namespace app\controller;

use app\model\Student;
use app\model\User;
use Exception;

class StudentController extends Controller
{
    public function genererPageNewStudent()
    {
        $this->checkLogin();

        $data = [
            'page_title' => 'Trombinoscope - Nouvel étudiant',
            'view' => 'app/view/new-student.view.php',
            'layout' => 'app/view/common/layout.php',
        ];

        if (isset($_SESSION['data'])) {
            $data['student_data'] = $_SESSION['data'];
            unset($_SESSION['data']);
        }

        $this->genererPage($data);
    }

    public function createStudent()
    {
        $this->checkLogin();

        $complete = false;
        if (isset($_POST['submit'])) {
            $dataToCheck = ['firstname', 'lastname', 'birthdate', 'group', 'description'];

            $complete = true;
            $_SESSION['data'] = [];
            foreach ($dataToCheck as $data) {
                if (empty($_POST[$data])) {
                    $complete = false;
                    $_SESSION['data'][$data] = "";
                } else {
                    $_SESSION['data'][$data] = $_POST[$data];
                }
            }
        }

        if (!$complete) {
            $this->redirectToPageWithError('index.php?page=new-student', "Le formulaire n'est pas complet");
        }

        if ($_FILES['fileToUpload']['size'] > 0) {
            $filename = $this->uploadFile();
        }

        try {
            $studentId = Student::create(
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['birthdate'],
                $_POST['group'],
                $_POST['description'],
                $filename ?? null
            );
        } catch (Exception $e) {
            $this->redirectToPageWithError('index.php?page=new-student', "Une erreur s'est produite lors de l'enregistrement");
        }

        header('Location: index.php?page=fiche&num=' . $studentId);
        exit();
    }

    private function checkLogin()
    {
        $user = new User();
        if (!$user->isAdmin()) {
            $this->redirectToPageWithError('index.php?page=login', "Vous n'avez pas les droits d'accès à cette page");
        }
    }


    private function uploadFile(): string
    {
        $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
        $this->checkUploadImage($imageFileType);
        $imageSource = $this->createSourceImage($imageFileType);
        $filename = $_POST['group'] . '_' . strtolower($_POST['firstname']) . '_' . strtolower($_POST['lastname']) . '.png';
        $imageBig = $this->saveAndRedimImage($imageSource, 400, "public/images/groupe" . $_POST['group'] . '/big/' . $filename);
        imagedestroy($imageSource);
        $imageSmall = $this->saveAndRedimImage($imageBig, 120, "public/images/groupe" . $_POST['group'] . '/small/' . $filename);
        imagedestroy($imageBig);
        imagedestroy($imageSmall);
        return $filename;
    }

    private function checkUploadImage(string $imageFileType)
    {
        if (!getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
            $_SESSION['message'] = "Le fichier n'est pas une image";
            header('Location: index.php?page=new-student');
            exit;
        }

        // Vérifie la taille du fichier
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $_SESSION['message'] = "Le fichier est trop volumineux";
            header('Location: index.php?page=new-student');
            exit;
        }

        // Autorise certains formats de fichiers
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $_SESSION['message'] = "Seuls les fichiers JPG, JPEG, PNG sont autorisés.";
            header('Location: index.php?page=new-student');
            exit;
        }
        return true;
    }

    private function createSourceImage(string $imageFileType)
    {
        if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
            return imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
        } else if ($imageFileType == "png") {
            return imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
        }
        return null;
    }

    private function saveAndRedimImage($imageSource, $largeur, $targetFile)
    {

        $hauteur = intval($largeur * (imagesy($imageSource) / imagesx($imageSource)));
        $image = imagecreatetruecolor($largeur, $hauteur);
        if (
            !imagecopyresampled($image, $imageSource, 0, 0, 0, 0, $largeur, $hauteur, imagesx($imageSource), imagesy($imageSource)) ||
            !imagepng($image, $targetFile)
        ) {
            imagedestroy($imageSource);
            imagedestroy($image);
            $_SESSION['message'] = "Il y a eu une erreur lors du chargement de l'image";
            header('Location: index.php?page=new-student');
            exit;
        }
        return $image;
    }
}
