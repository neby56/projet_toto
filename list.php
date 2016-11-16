<?php

require 'inc/config.php';


$idSession = isset($_GET['id']) ? intval($_GET['id']) : 0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$search = isset($_GET['q']) ? trim($_GET['q']) : '' ;


$studentListe = array();
$offset = ($page - 1) * 3;
$limite = isset($_POST['limite']) ? intval($_POST['limite']): 3;

$sql = "SELECT *
FROM student
LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id";

if($idSession){
$sql .= " WHERE training_tra_id = :idSess";
}
$sql .= " LIMIT ".$offset.",".$limite;

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':idSess', $idSession);

if(!$pdoStatement->execute()){
	print_r($pdoStatement->errorInfo());
}else{
	$studentListe = $pdoStatement->fetchAll();
	foreach ($studentListe as $key => $value) {
		$studentListe[$key]['birthdate'] = date('Y') - $studentListe[$key]['stu_age'];
		$studentListe[$key]['stu_friendliness'] = Sympathie($studentListe[$key]['stu_friendliness']);
	}
}

$precedent="list.php?id=".$idSession."&page=1";

if($page>1){
	$precedent = "list.php?id=".$idSession."&page=".($page-1);
}

$suivant = "list.php?id=".$idSession."&page=".($page+1);

require 'views/header.php';
require 'views/listSession.php';
require 'views/footer.php';