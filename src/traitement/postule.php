<?php
session_start();
require_once '../modele/Postule.php';
require_once '../bdd/Database.php';

$bdd = new Database();
$postule = new Postule(array(
    'RefEtudiant'=>$_SESSION['id'],
    'RefOffre'=>$_SESSION['current_offre']
));
$postule->insertPostule($bdd);
//if (true){
//    $_SESSION['e'] = "errorInsert";
//}
//else $_SESSION['e'] = "sucessInsert";
//header('Location: ../../vue/voir_offre.php');