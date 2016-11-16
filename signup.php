<?php

require 'inc/config.php';
require 'views/header.php';

$email = '';

// Formulaire soumis
if (!empty($_POST)) {
	print_r($_POST);
	
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';
	$password2 = isset($_POST['password2']) ? trim($_POST['password2']) : '';

	$formOk = true;
	if ($password != $password2) {
		echo 'Le mot de passe n\'est pas identique<br>';
		$formOk = false;
	}
	if (strlen($password) < 8) {
		echo 'Le password doit contenir au moins 8 caractères<br>';
		var_dump($password);
		$formOk = false;
	}
	if (empty($email)) {
		echo 'Email est vide<br>';
		$formOk = false;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Email invalide<br>';
		$formOk = false;
	}

	$sql1 = 'SELECT * FROM user';
		$pdoStatement = $pdo->query($sql1);
		if ($pdoStatement === false) {
			print_r($pdo->errorInfo());
		}
		else {
			$data = $pdoStatement->fetchAll();
			if(!empty($data)){
				if($email == $data['usr_email']){
					echo"L'adresse mail encodé existe déjà";
					$formOk = false;
				}
			}
		}

	if ($formOk) {
		echo 'OK<br>TODO insérer en DB<br>';

		$_SESSION['UserId'] = session_id();

		$sql = '
			INSERT INTO user (usr_email, 
usr_password) VALUES (:email, :password)
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $email);
		//$pdoStatement->bindValue(':password', md5($passwordToto1)); // md5 simple
		//$pdoStatement->bindValue(':password', md5($passwordToto1.'jhdvb9l78!okcvnflk')); // md5 + salt
		$pdoStatement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT)); // password_hash

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			$resultat = $pdoStatement->fetchAll();
			echo "Je vous ai ajouté à ma base de données";
			header('Location: signup.php');
		}
	}

}

require 'views/ViewSignup.php';
require 'views/footer.php';
?>