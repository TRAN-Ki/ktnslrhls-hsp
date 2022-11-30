<?php
session_start();
require_once '../modele/Inscrit.php';
require_once '../bdd/Database.php';

$bdd = new Database();
$inscrit = new Inscrit(array(
    'refetudiant'=>$_SESSION['id'],
    'refconference'=>$_POST['validForm']
));
$res = $inscrit->selectInscritRef($bdd);

if (!$res){
    $inscrit->addInscrit($bdd);
    echo "OK";
}
else{
    $inscrit->deleteInscrit();
}

echo "PAS OK";
header('Location: ../../vue/vue-utilisateur.php');