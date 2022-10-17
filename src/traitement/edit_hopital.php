<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$hopital = new Hopital([
    'id'=>$_POST['id'],
    'nom'=>$_POST['nom'],
    'rue'=>$_POST['rue'],
    'cp'=>$_POST['cp']
]);

$hopital->editHopital();