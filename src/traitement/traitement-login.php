<?php
require_once '../modele/Representant.php';
require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';
$bdd = new Database();

$log = new Utilisateur(array(
    'email' =>$_POST['email'],
    'mdp' =>$_POST['mdp'],
));
$res = $log->testLogin($bdd);

if ($res != null){
    session_start();
    if ($res['admin'] == 1 && $res['actif'] == 0){
        $_SESSION['isAdmin'] = $res['admin'];
        echo "admin";
    }
    if ($res['admin'] == 0 && $res['actif'] == 0) {
        echo "non";
    }elseif($res['actif'] == 1){

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = $res['id_utilisateur'];

        $log1 = new Representant(array(
            'refUtilisateur' =>$_SESSION['id'],
        ));
        $res1 = $log1->isRepresentant($bdd);
        if (isset($res1['ref_utilisateur'])) {
            $_SESSION['isRepr'] = 1;
            $_SESSION['isEtud'] = 0;
        }
        else{
            $_SESSION['isRepr'] = 0;
            $_SESSION['isEtud'] = 1;
        }
        echo "oui";
    }
//TODO: $_SESSION['isRepr'], faire méthode et récupérer étudiant (0) ou représentant (0)
}
