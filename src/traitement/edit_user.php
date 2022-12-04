<?php
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();
$user = new Utilisateur(array(
    'nom' =>$_POST['nom'],
    'prenom' =>$_POST['prenom'],
    'email' =>$_POST['email'],
    'actif'=>$_POST['actif'],
    'id' =>$_POST['id']

));

$user->updateUtilisateur($bdd);
header('Location: ../../vue/panelAdmin/utilisateur.php');