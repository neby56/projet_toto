	<?php
require 'views/header.php';
require 'inc/config.php';

$citiesList = array(
	1 => 'Esch-sur-Alzette',
	2 => 'Verdun4',
	3 => 'Luxembourg2',
	4 => 'Metz',
	5 => 'Differdange',
	6 => 'Rosport',
	7 => 'Bascharage',
);
$countriesList = array(
	1 => 'Luxembourg',
	2 => 'France',
	3 => 'Belgique',
	4 => 'Chine',
);
$sympathieList = array(
	1 => 'Pas sympa',
	2 => 'Assez sympa',
	3 => 'Sympa',
	4 => 'Très sympa',
	5 => 'Génial',
);

$formOk = true;
if(!empty($_POST)){

	$studentName = isset($_POST['studentName'])?trim($_POST['studentName']) : '';
	$studentFirstname = isset($_POST['studentFirstname'])?trim($_POST['studentFirstname']) : '';
	$studentEmail = isset($_POST['studentEmail'])?trim($_POST['studentEmail']) : '';
	$studentBirhtdate = isset($_POST['studentAge'])?intval($_POST['studentAge']) : '';
	$cit_id = isset($_POST['cit_id']) && is_numeric($_POST['cit_id']) ? ($_POST['cit_id']) : 0;
	$cou_id = isset($_POST['cou_id']) && is_numeric($_POST['cou_id']) ? ($_POST['cou_id']) : 0;
	$stu_friendliness = is_numeric($_POST['stu_friendliness']) ? ($_POST['stu_friendliness']) : 0;

	if(strlen($studentName) < 2){
		echo "le nom doit avoir minimum 2 caractères<br/>";
		$formOk = false;
	}

	if(strlen($studentFirstname) < 2){
		echo "Le prénom doit avoir minimum 2 caractères<br/>";
		$formOk = false;
	}

	if(filter_var($studentEmail, FILTER_VALIDATE_EMAIL) === false){
		echo "L'adresse mail est incorrecte<br/>";
		$formOk = false;
	}

	if($studentAge < 10){
		echo "Il faut avoir minimum 10 ans<br/>";
		$formOk = false;
	}

	if($cit_id  == 0){
		echo "Il faut remplir la ville<br/>";
		$formOk = false;
	}

	if($stu_friendliness  == 0){
		echo "Il faut remplir la sympathie<br/>";
		$formOk = false;
	}

	if($formOk){
		$sql = "INSERT INTO student(stu_lname, stu_fname, stu_email, stu_friendliness, city_cit_id, stu_age, training_tra_id) VALUES (:stuNom, :stuPrenom, :stuEmail, :stuFriendliness, :stuCityId, :stuAge, :traId) ";
		echo "Je vous ai ajouté dans ma base de données";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindValue(':stuNom', $studentName);
		$pdoStatement->bindValue(':stuPrenom', $studentFirstname);
		$pdoStatement->bindValue(':stuEmail', $studentEmail);
		$pdoStatement->bindValue(':stuAge', $studentAge, PDO::PARAM_INT);
		$pdoStatement->bindValue(':stuCityId', $cit_id, PDO::PARAM_INT);
		$pdoStatement->bindValue(':traId', 3, PDO::PARAM_INT);
		$pdoStatement->bindValue(':stuFriendliness', $stu_friendliness, PDO::PARAM_INT);

		if(!$pdoStatement->execute()){
			print_r($pdo->errorInfo());
		}else{
			$resultat = $pdoStatement->fetchAll();
		}
	}

}

require 'views/addEtudiant.php';
require 'views/footer.php';
?>