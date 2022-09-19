<?php

require_once '../bdd/Database.php';

$bdd = new Database();

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur");
$log->execute();

//verifier
//en attente
