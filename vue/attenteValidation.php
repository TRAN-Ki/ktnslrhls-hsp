<?php

require_once '../src/modele/Utilisateur.php';

session_start();

$usr = new Utilisateur(); // hydrate

var_dump($_SESSION);

// html + JS


?>
