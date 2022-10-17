<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$user = new Hopital(array(
    'Nom'=>$_POST['nom'],
    'Rue'=>$_POST['rue'],
    'Cp'=>$_POST['cp'],
));

$user->addHopital($bdd);

