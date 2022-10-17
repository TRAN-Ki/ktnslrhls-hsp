<?php
require_once '../modele/Amphitheatre.php';
require_once '../bdd/Database.php';

$bdd = new Database();
$amphi = new Amphitheatre(array(
        'id'=>$_POST['id']
));
var_dump($amphi);
var_dump($_POST);
$amphi->deleteAmphitheatre();