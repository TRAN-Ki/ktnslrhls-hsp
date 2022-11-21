<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';
$bdd = new Database();

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE email = :email AND mdp = :mdp");
$log->execute(array(
    'email'=>$_POST['email'],
    'mdp'=>$_POST['mdp']
));
$res = $log->fetch();
//TODO: mettre la méthode du dessus, dans Utilisateur.php
if ($res != null){
    session_start();
    if ($res['admin'] == 1 && $res['actif'] == 0){
        $_SESSION['isAdmin'] = $res['admin'];
        echo "admin";
    }
    if ($res['admin'] == 0 && $res['actif'] == 0) {
        echo "non";
    }elseif($res['actif'] == 1){
        echo "oui";
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = $res['id_utilisateur'];
    }
//TODO: $_SESSION['isRepr'], faire méthode et récupérer étudiant (0) ou représentant (0)
}
