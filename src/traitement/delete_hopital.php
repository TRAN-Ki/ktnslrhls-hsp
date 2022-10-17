<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$user = new Hopital([
        'Id'=>$_POST['id']
    ]);

$user->deleteHopital();