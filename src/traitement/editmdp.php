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

$user = new Utilisateur(array(
    'email' =>$_SESSION['email'],
    'id' =>$res['id']
));


if($res){




}