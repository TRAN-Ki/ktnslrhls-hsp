<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$hop = new Hopital([
    'id'=>$_POST['id']
]);
var_dump($hop);
var_dump($_POST);
$hop->deleteHopital();
