<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$user = new Hopital(array(
    'nom'=>$_POST['nom'],
    'rue'=>$_POST['rue'],
    'cp'=>$_POST['cp']
));

$user->addHopital($bdd);

header('Location: ../../vue/panelAdmin/hopital.php');

