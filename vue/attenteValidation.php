<?php

require_once '../src/modele/Utilisateur.php';

session_start();

var_dump($_SESSION);

header("Location: ../index.php");
//TODO: Appliquer la template + page d'attente + bouton de redirection à l'accueil
?>

