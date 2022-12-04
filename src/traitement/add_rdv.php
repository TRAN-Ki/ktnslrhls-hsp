<?php
require_once '../bdd/Database.php';
require_once '../modele/Rdv.php';
require_once '../modele/Mail.php';
session_start();

$mail = new Mail("",$_SESSION['email']);
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
$mail->sendMail("RDV ajouté","Bonjour, <br><br>Vous venez de rajouté un rendez vous. <br>Accéder a votre espace pour le consulter. <br><br> Bien cordialement,");
header('Location: ../../vue/vue-rdv.php');

