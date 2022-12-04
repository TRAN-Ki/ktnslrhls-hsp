<?php
require_once "../modele/Utilisateur.php";
require_once "../bdd/Database.php";
session_start();

$bdd = new Database();
$user = new Utilisateur(array(
    'id'=>$_POST['id']
));

$user->validUser($bdd);

header("Location: ../../index.php");