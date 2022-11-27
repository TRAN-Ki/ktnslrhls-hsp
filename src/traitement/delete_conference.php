<?php
require_once '../bdd/Database.php';
require_once '../modele/Conference.php';

$bdd = new Database();
$conf = new Conference([
    'id'=>$_POST['id']
]);

$conf->deleteConference();

header('Location: ../../vue/panelAdmin/conference.php');
