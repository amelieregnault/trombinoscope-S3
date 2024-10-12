<?php

require_once "app/model/Student.php";

$paul = new Student();
$paul->setPrenom('Paul');
$paul->setNom('Richard');

echo $paul->getNom();

echo '<pre>';
var_dump($paul);
echo '</pre>';