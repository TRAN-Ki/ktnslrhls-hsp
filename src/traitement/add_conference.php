<?php
require_once '../bdd/Database.php';
require_once '../modele/Conference.php';

$bdd = new Database();
$conf = new Conference(array(
    'nom'=>$_POST['nom'],
    'description'=>$_POST['desc'],
    'dateconf'=>$_POST['date'],
    'heure'=>$_POST['heure'],
    'duree'=>$_POST['duree'],
    'valider'=>$_POST['valider'],
    'refamphitheatre'=>$_POST['ref']
));

$conf->addConference($bdd);
var_dump($conf);
header('Location: ../../vue/panelAdmin/conference.php');