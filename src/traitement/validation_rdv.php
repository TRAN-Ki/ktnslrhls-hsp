<?php
require_once '../modele/Rdv.php';
require_once '../bdd/Database.php';
require_once '../modele/Mail.php';
require_once '../modele/Utilisateur.php';
session_start();
$rdv = new Rdv(array(
    'etat'=>1,
    'id'=>$_POST['id']
));
$bdd = new Database();
$user = new Utilisateur(array(
    'id'=>$_SESSION['id']
));
$res = $user->selectUtilisateur($bdd);

$rdv->setRefetudiant($_SESSION['id']);
$sel = $rdv->selectRdvEtu($bdd);


$mail = new Mail('',$res['email']);
$mail->sendMail("RDV numéro ".$_POST['id'],'Bonjour, <br>Votre rendez-vous pour l\'offre numéro '.$sel[$_POST['id']]['ref_offre'].' se passera le '.$sel[$_POST['id']]['date_rdv'].' à l\'heure '.$sel[$_POST['id']]['heure'].'. <br><br> Bien cordialement,');
$rdv->updateRdvValider($bdd);
header('Location: ../../vue/vue-rdv.php');