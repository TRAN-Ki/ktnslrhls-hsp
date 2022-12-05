<?php
session_start();
require_once '../bdd/Database.php';
require_once '../modele/Conference.php';

$bdd = new Database();
$conf = new Conference(array(
    'nom'=>$_POST['nom'],
    'description'=>$_POST['desc'],
    'dateconf'=>$_POST['date'],
    'heure'=>$_POST['heure'],
    'duree'=>$_POST['duree'],
    'valider'=>0,
    'refutilisateur'=>$_SESSION['id']
));

$conf->addConference($bdd);
$_SESSION['e'] = "sucessConf";
header('Location: ../../vue/vue-utilisateur.php');