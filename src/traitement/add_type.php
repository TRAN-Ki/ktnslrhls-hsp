<?php
require_once '../bdd/Database.php';
require_once '../modele/Type.php';

$bdd = new Database();
$type = new Type(array(
    'libelle' => $_POST['libelle']
));

$type->addType($bdd);

header('Location: ../../vue/panelAdmin/type.php');