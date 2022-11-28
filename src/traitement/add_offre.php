<?php
require_once '../bdd/Database.php';
require_once '../modele/Offre.php';
session_start();
var_dump($_POST);
var_dump($_SESSION);
var_dump($_SESSION['id']);

$bdd = new Database();
$user = new Offre(array(
    'libelle'=>$_POST['libelle'],
    'description'=>$_POST['description'],
    'refType'=>$_POST['ref_type'],
    'refRepresentant'=>$_SESSION['id']
));

$user->addOffre($bdd);
header('Location: ../../vue/vue-utilisateur.php');

