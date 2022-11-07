<?php
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();
$user = new Utilisateur(array(
    'nom' =>$_POST['nom'],
    'prenom' =>$_POST['prenom'],
    'email' =>$_POST['email'],
    'mdp' =>$_POST['mdp'],
    'admin' =>$_POST['admin'],
    'actif' =>$_POST['actif']
));

$user->addUtilisateur($bdd);
header('Location: ../../vue/panelAdmin/utilisateur.php');