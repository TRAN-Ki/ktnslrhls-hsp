<?php
require_once '../modele/Amphitheatre.php';
require_once '../bdd/Database.php';

$bdd = new Database();
$amphi = new Amphitheatre(array(
        'id'=>$_POST['id']
));

$amphi->deleteAmphitheatre();

header('Location: ../../vue/panelAdmin/amphitheatre.php');