<?php

function uploadFile(): string
{
    $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
    checkUploadImage($imageFileType);
    $imageSource = createSourceImage($imageFileType);
    $filename = $_POST['group'] . '_' . strtolower($_POST['firstname']) . '_' . strtolower($_POST['lastname']) . '.png';
    $imageBig = saveAndRedimImage($imageSource, 400, "public/images/groupe". $_POST['group'] . '/big/' . $filename);
    imagedestroy($imageSource);
    $imageSmall = saveAndRedimImage($imageBig, 120, "public/images/groupe". $_POST['group'] . '/small/' . $filename);
    imagedestroy($imageBig);
    imagedestroy($imageSmall);
    return $filename;
}

function checkUploadImage(string $imageFileType)
{
    if (!getimagesize($_FILES["fileToUpload"]["tmp_name"])) {
        $_SESSION['message'] = "Le fichier n'est pas une image";
        header('Location: new_student.php');
        exit;
    }

    // Vérifie la taille du fichier
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['message'] = "Le fichier est trop volumineux";
        header('Location: new_student.php');
        exit;
    }

    // Autorise certains formats de fichiers
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['message'] = "Seuls les fichiers JPG, JPEG, PNG sont autorisés.";
        header('Location: new_student.php');
        exit;
    }
    return true;
}

function createSourceImage(string $imageFileType)
{
    if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
        return imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
    } else if ($imageFileType == "png") {
        return imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
    }
    return null;
}

function saveAndRedimImage($imageSource, $largeur, $targetFile)
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
        header('Location: new_student.php');
        exit;
    }
    return $image;
}