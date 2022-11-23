<?php
require_once '../bdd/Database.php';
require_once '../modele/Offre.php';

$bdd = new Database();
$user = new Offre(array(
    'libelle'=>$_POST['libelle'],
    'description'=>$_POST['description'],
    'ref_type'=>$_POST['ref_type'],
    'ref_representant'=>$_POST['ref_representant'],
));

$user->addOffre($bdd);

header('Location: ../../vue/vue-utilisateur.php');

