<?php
require_once '../bdd/Database.php';
require_once '../modele/Type.php';

$bdd = new Database();
$type = new Type(array(
    'id'=>$_POST['id']
));

$type->deleteType();

header('Location: ../../vue/panelAdmin/type.php');