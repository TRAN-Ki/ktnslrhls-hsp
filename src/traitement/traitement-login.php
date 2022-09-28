<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();

$usr = new Utilisateur(); //hydrate

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE email = :email AND mdp = :mdp");
$log->execute(array(
    'email'=>$_POST['email'],
    'mdp'=>$_POST['mdp']
));
if ($res = $log->fetch()){
    //en attente
    session_start();
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['mdp'] = $_POST['mdp'];

    header("Location: ../../vue/attenteValidation ");

}else{

    header("Location: ../../vue/login.php");
    // erreur id/mdp -> à faire en html + js
}
