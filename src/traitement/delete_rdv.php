<?php
require_once '../bdd/Database.php';
require_once '../modele/Rdv.php';

$bdd = new Database();
$rdv = new Rdv(array(
    'id'=>$_POST['id']
));

$rdv->deleteRdv();

header('Location: ../../vue/vue-rdv.php');