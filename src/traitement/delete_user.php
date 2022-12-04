<?php
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';


$bdd = new Database();
$user = new Utilisateur(array(
    'id'=>$_POST['id']
));

$user->deleteUtilisateur($bdd);
header('Location: ../../vue/panelAdmin/utilisateur.php');