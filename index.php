<?php

require 'vendor/autoload.php';
require 'inc/config.php';

use SocialLinks\Page;

$page = new Page([
    'url' => 'http://mypage.com',
    'title' => 'Page title',
    'text' => 'Extended page description',
    'image' => 'http://mypage.com/image.png',
    'twitterUser' => '@twitterUser'
]);

$trainingList = array();

$sql = 'SELECT tra_id, tra_start_date, tra_end_date, count(*) as nb 
FROM training
LEFT OUTER JOIN student ON student.training_tra_id = training.tra_id
GROUP BY tra_id';

$pdoStatement = $pdo->query($sql);

if($pdoStatement === false){
	print_r($pdo->errorInfo());
}else{
	$trainingList = $pdoStatement->fetchAll();
}
/*
EXERCICE++
------------------------
- n'autoriser que certaines extensions à être uploader
	jpg, jpeg, gif, svg, png
	
EXERCICE-extra
------------------------
- faire un formulaire à part, où on upload un zip
- vérifier que c'est bien un zip
- décompresser le fichier
- supprimer tout fichier php qui aurait été décompressé
- afficher à l'écran les fichiers et dossiers décompressés
*/
// VIEW
require 'views/header.php';
require 'views/home.php';
require 'views/footer.php';