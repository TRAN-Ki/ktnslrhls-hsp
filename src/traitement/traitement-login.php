<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';
var_dump($_POST);
$bdd = new Database();

$log = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur WHERE email = :email AND mdp = :mdp");
$log->execute(array(
    'email'=>$_POST['email'],
    'mdp'=>$_POST['mdp']
));
if ($res = $log->fetch()){
    session_start();
    if ($res['admin'] && $res['actif'] == 1){
        $_SESSION['isAdmin'] = $res['admin'];
        echo "admin";
    }
    if ($res['actif'] == 0) {
        echo "non";
        //header("Location: ../../vue/attenteValidation.php");
    }elseif($res['actif'] == 1){
        echo "actif";
        $_SESSION['email'] = $_POST['email'];
        header("Location: ../../vue/vue-utilisateur.php");
    }
}else{
    echo "<script>console.log('erreur')</script>";
    //header("Location: ../../index.php");
}
