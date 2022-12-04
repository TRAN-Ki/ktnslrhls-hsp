<?php
require_once '../bdd/Database.php';
require_once '../modele/Rdv.php';
//TODO : EDIT NE FONCTIONNE PAS
$bdd = new Database();
$rdv = new Rdv(array(
    'id'=>$_POST['id'],
    'date'=>$_POST['dates'],
    'heure'=>$_POST['heure'],
    'etat'=>$_POST['etat'],
    'refetudiant'=>$_POST['refetu'],
    'refrepresentant'=>$_POST['refrep'],
    'refoffre'=>$_POST['refoff']
));

$rdv->editRdv();

header('Location: ../../vue/vue-rdv.php');