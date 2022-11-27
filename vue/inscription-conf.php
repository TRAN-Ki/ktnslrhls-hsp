<?php

require_once '../src/modele/Conference.php';
require_once '../src/bdd/Database.php';

$bdd = new Database();
$conf = new Conference(array());
//TODO: S'inscrire a une conférence