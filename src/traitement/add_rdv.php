<?php
require_once '../bdd/Database.php';
require_once '../modele/Rdv.php';
session_start();

$bdd = new Database();
$rdv = new Rdv(array(
    'date'=>$_POST['dates'],
    'heure'=>$_POST['heure'],
    'etat'=>0,
    'refetudiant'=>$_POST['refetu'],
    'refrepresentant'=>$_POST['refrep'],
    'refoffre'=>$_POST['refoff']
));

$rdv->addRdv($bdd);

header('Location: ../../vue/vue-rdv.php');

