<?php

require_once '../../src/bdd/Database.php';
// TODO : importer les méthodes dans Utilisateur.php
session_start();

$bdd = new Database();

$req = $bdd->getBdd()->prepare("SELECT * FROM utilisateur WHERE email = :email");
$req->execute(array(
    'email'=>$_SESSION['email']
));
$res = $req->fetch();

if($res){

    $up = $bdd->getBdd()->prepare("UPDATE utilisateur SET mdp = :mdp WHERE email = :email");
    $up->execute(array(
        'mdp'=>$_POST['mdp'],
        'email'=>$_SESSION['email']
    ));

}