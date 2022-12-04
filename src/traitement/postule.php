<?php
session_start();
require_once '../modele/Postule.php';
require_once '../bdd/Database.php';

$bdd = new Database();
$postule = new Postule(array(
    'RefEtudiant'=>$_SESSION['id'],
    'RefOffre'=>$_SESSION['current_offre']
));
$result = $postule->selectPostuleByRef($bdd);
if ($result){
    $_SESSION['e'] = "errorInsert";
}
else {
    $_SESSION['e'] = "sucessInsert";
    $postule->insertPostule($bdd);
}
header('Location: ../../vue/voir_offre.php');