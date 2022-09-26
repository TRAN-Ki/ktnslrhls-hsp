<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();
$user = new Utilisateur(); // parametre hydrate

session_start();

try {

    $res = "";
    $user->selectUtilisateur($res);

    if(!$res->fetch()){

        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setMdp($_POST['mdp']);
        $user->setAdmin(0);
        $user->setActif(0);
        $user->addUtilisateur($bdd);

        // choiceBox
        if ($_POST['choix'] == "représentant"){

            // faire un insert dans representant

        }elseif ($_POST['choix'] == "etudiant"){

            // faire un insert dans etudiant

        }

        header('Location: ../../vue/login.php');
    }else{
        header('Location: ../../vue/register.php');
    }

}catch(PDOException $e){
    echo $e;
}


