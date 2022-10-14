<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE email = :email AND mdp = :mdp");
$log->execute(array(
    'email'=>$_POST['email'],
    'mdp'=>$_POST['mdp']
));
if ($res = $log->fetch()){
    //en attente
    session_start();
    if ($res['admin']){
        $_SESSION['isAdmin'] = $res['admin'];
    }
    if ($res['actif'] == 0) {
        header("Location: ../../vue/attenteValidation.php");
    }elseif($res['actif'] == 1){
        $_SESSION['email'] = $_POST['email'];
        header("Location: ../../vue/vue-utilisateur.php");
    }
}else{

    header("Location: ../../index.php");
}
