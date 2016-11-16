<?php

require 'inc/config.php';
require 'views/header.php';

function checkLoginPassword($passwordLogin, $emailLogin){
	$formOk = true;
	if (strlen($passwordLogin) < 8) {
		echo 'Le password doit contenir au moins 8 caractères<br>';
		$formOk = false;
	}
	if (empty($emailLogin)) {
		echo 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
		echo 'Email invalide<br>';
		$formOk = false;
	}

	return $formOk;
}

if (!empty($_POST)) {
	$emailLogin = isset($_POST['emailLogin']) ? trim($_POST['emailLogin']) : '';
	$passwordLogin = isset($_POST['passwordLogin']) ? trim($_POST['passwordLogin']) : '';

	$formOk = checkLoginPassword($emailLogin, $passwordLogin);

	$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			LIMIT 1
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLogin);

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else 
		{
			if ($pdoStatement->rowCount() > 0) {
				$resList = $pdoStatement->fetch();
				$hashedPassword = $resList['usr_password'];

				// Je vérifie le mot de passe
				if (password_verify($passwordLogin, $hashedPassword)) {
					echo 'login ok<br>';
				}
				else {
					echo 'bad password or login<br>';
				}
			}
			else {
				echo 'email not known<br>';
			}
		}
}


//VIEW
require 'views/VieuwSignin.php';
require 'views/footer.php';
?>