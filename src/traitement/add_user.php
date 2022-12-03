<?php
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();
if ($_POST['choix'] == 'adm'){
    $_POST['choix'] = 1;
}else{
    $_POST['choix'] = 0;
}
$user = new Utilisateur(array(
    'nom' =>$_POST['nom'],
    'prenom' =>$_POST['prenom'],
    'email' =>$_POST['email'],
    'mdp' =>$_POST['mdp'],
    'admin' =>$_POST['choix'],
    'actif' =>$_POST['actif']
));

$user->addUtilisateur($bdd);
header('Location: ../../vue/panelAdmin/utilisateur.php');