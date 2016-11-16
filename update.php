<?php

require 'inc/config.php';

//VIEW
require 'views/header.php';

$studentListe = array();

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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "
SELECT * 
FROM student 
LEFT OUTER JOIN city ON city.cit_id = student.city_cit_id
LEFT OUTER JOIN country ON country.cou_id = city.country_cou_id 
WHERE stu_id = ".$id;

$pdoStatement = $pdo->query($sql);

if($pdoStatement === false){
	print_r($pdo->errorInfo());
}else{
	$studentListe = $pdoStatement->fetch();
    $studentListe['birthdate'] = date('Y') - $studentListe['stu_age'];
}

$studentName = $studentListe['stu_lname'];
$studentFirstname = $studentListe['stu_fname'];
$studentEmail = $studentListe['stu_email'];
$studentAge = $studentListe['stu_age'];
$ville = $studentListe['cit_name'];
$pays= $studentListe['cou_name'];
$sympa = $studentListe['stu_friendliness'];
$idEtudiant = $studentListe['stu_id'];
$image = $studentListe['Image'];

$formOk = true;
if(!empty($_POST)){
	$studentName = isset($_POST['studentName'])?trim($_POST['studentName']) : '';
	$studentFirstname = isset($_POST['studentFirstname'])?trim($_POST['studentFirstname']) : '';
	$studentEmail = isset($_POST['studentEmail'])?trim($_POST['studentEmail']) : '';
	$studentAge = isset($_POST['studentAge'])?intval($_POST['studentAge']) : '';
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
		echo "Il faut avoir minimun 10 ans<br/>";
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

	// Si des fichiers ont été téléversés
	if (sizeof($_FILES) > 0) {
		// Je récupère les données du fichier 'fileForm'
		$image = $_FILES['image'];

		// Je teste si la taille n'est pas trop importante
		if ($image['size'] <= 100000) {
			// Je récupère l'extension
			$tmp = explode('.', $image['name']);
			$extension = end($tmp);

			// Tableau des extensions autorisées
			$allowedExtensions = array('png', 'svg', 'jpeg', 'jpg', 'gif');

			if (in_array($extension, $allowedExtensions)) {
				// Je téléverse le fichier
				if(move_uploaded_file($image['tmp_name'], 'files/test_upload'.$extension)) {
					echo 'fichier téléversé<br>';
				}
				else {
					echo 'Erreur dans le téléversement<br>';
				}
			}
			else {
				echo 'petit malin ^^<br>';
			}
		}
		else {
			echo 'Fichier trop grand...<br>';
		}
	}
	else{
		echo"n'importe quoi";
	}
exit;
	if($formOk){
		$sql = "
		UPDATE student 
		SET stu_lname = :stuNom, stu_fname = :stuPrenom, stu_email = :stuEmail, stu_friendliness = :stuFriendliness, city_cit_id = :stuCityId, stu_age = :stuAge, Image = :stuImage
		WHERE stu_id = ".$idEtudiant;
		echo "Je vous ai modifié dans ma base de données";

		$pdoStatement = $pdo->prepare($sql);

		$pdoStatement->bindValue(':stuNom', $studentName);
		$pdoStatement->bindValue(':stuPrenom', $studentFirstname);
		$pdoStatement->bindValue(':stuEmail', $studentEmail);
		$pdoStatement->bindValue(':stuAge', $studentAge, PDO::PARAM_INT);
		$pdoStatement->bindValue(':stuCityId', $cit_id, PDO::PARAM_INT);
		$pdoStatement->bindValue(':stuFriendliness', $stu_friendliness, PDO::PARAM_INT);
		$pdoStatement->bindValue(':stuImage', $image);

		if(!$pdoStatement->execute()){
			print_r($pdo->errorInfo());
		}else{
			$resultat = $pdoStatement->fetchAll();
		}

		header("Location: student.php?id=".$idEtudiant);
	}

/* EXERCICE 1
------------------------
- modifier votre projet Toto pour pouvoir uploader une image pour chaque student (dans update.php si possible, sinon add.php)
- ne pas accepter les fichiers PHP dans cet upload*/

}

require 'views/viewUpdate.php';
require 'views/footer.php';

?>