<?php

session_start();
 
// Constante pour définir la configuration de la DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'ouehbi,malika');
define('DB_DATABASE', 'nous');

$dsn = 'mysql:dbname='.DB_DATABASE.';host='.DB_HOST.';charset=UTF8';

try{
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}
catch(Exception $e){
	echo $e->getMessage();
}

function Sympathie($stu_friendliness){
	switch ($stu_friendliness) {
		case 1:
			$stu_friendliness='Pas sympa';
			break;
		case 2:
			$stu_friendliness='Assez sympa';
			break;
		case 1:
			$stu_friendliness='Sympa';
			break;
		case 1:
			$stu_friendliness='Très sympa';
			break;
		case 1:
			$stu_friendliness='Génial';
			break;
		default:
			$stu_friendliness='pas de commentaires';
			break;
	}
	return $stu_friendliness;
}