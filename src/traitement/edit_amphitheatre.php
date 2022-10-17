<?php
require_once '../bdd/Database.php';
require_once '../modele/Amphitheatre.php';

$bdd = new Database();
$amphi = new Amphitheatre(array(
    'id'=>$_POST['id'],
    'libelle'=>$_POST['libelle'],
    'nbplaces'=>$_POST['nbplaces']
));

$amphi->editAmphitheatre();

header('Location: ../../vue/panelAdmin/amphitheatre.php');