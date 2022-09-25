<?php

require_once '../bdd/Database.php';

$bdd = new Database();

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur");
$log->execute();

//verifier

if($result = $log->fetch()){

    //en attente


    header("Location: //adresse de espace membre ");

}else{

    header("Location: ../../traitement/register.php");

}




