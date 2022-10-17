<?php
require_once '../bdd/Database.php';
require_once '../modele/Hopital.php';

$bdd = new Database();
$user = new Amphitheatre(array(
        'id'=>$_POST['id']
));

$user->deleteAmphitheatre();