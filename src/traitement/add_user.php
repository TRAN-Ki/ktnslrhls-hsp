<?php
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();

$user = new Utilisateur(array(
    'nom' =>$_POST['nom'],
    'prenom' =>$_POST['prenom'],
    'email' =>$_POST['email'],
    'mdp' =>password_hash($_POST['mdp'], PASSWORD_DEFAULT),
    'admin' =>1,
    'actif' =>0
));

$user->addUtilisateur($bdd);
header('Location: ../../vue/panelAdmin/utilisateur.php');