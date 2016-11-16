<?php

require 'inc/config.php';

$idEtudiant = isset($_GET['id']) ? intval($_GET['id']) : 0;

$studentListe = array();


$sql = "SELECT stu_id, stu_lname, stu_fname, cou_name, cit_name, stu_friendliness, stu_email, stu_age
FROM student
LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id";

if($idEtudiant){
$sql .= " WHERE stu_id = :idEtud";
}


$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':idEtud', $idEtudiant);

if(!$pdoStatement->execute()){
  print_r($pdoStatement->errorInfo());
}else{
  $studentListe = $pdoStatement ->fetchAll();
}

// VIEW
require 'views/header.php';
require 'views/viewStudent.php';
require 'views/footer.php';