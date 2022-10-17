<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$hop = new Hopital([
    'id'=>$_POST['id']
]);

$hop->deleteHopital();

header('Location: ../../vue/panelAdmin/hopital.php');
