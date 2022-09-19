<?php

require_once '../bdd/Database.php';

$bdd = new Database();

try {
    $reg = $bdd->getBdd()->prepare("SELECT * FROM Utilisateur");
    $reg->execute();

    if(!$res = $reg->fetch()){
        $inscrit = $bdd->getBdd()->prepare("INSERT INTO Utilisateur (nom,prenom,email,mdp,admin,actif) VALUES (?,?,?,?,?,?)");
        $inscrit->execute(array(
            'nom'=>$_POST['nom'],
            'prenom'=>$_POST['prenom'],
            'email'=>$_POST['email'],
            'mdp'=>$_POST['mdp'],
            'admin'=>0,
            'actif'=>0
        ));

        header('Location: ../../vue/login.php');
    }else{
        header('Location: ../../vue/register.php');
    }

}catch(PDOException $e){
    echo $e;
}


