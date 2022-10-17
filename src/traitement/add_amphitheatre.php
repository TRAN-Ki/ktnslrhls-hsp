<?php
require_once '../bdd/Database.php';
require_once '../modele/Amphitheatre.php';

$bdd = new Database();
$amphi = new Amphitheatre(array(
    'libelle' => $_POST['libelle'],
    'nbplaces' => $_POST['nbrplaces']
));

$amphi->addAmphitheatre($bdd);