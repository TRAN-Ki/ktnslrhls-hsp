<?php

require_once '../src/modele/Utilisateur.php';

session_start();

var_dump($_SESSION);

header("Location: ../index.html");

?>
