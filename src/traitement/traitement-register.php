<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';
require_once '../modele/Etudiant.php';
require_once '../modele/Representant.php';

$bdd = new Database();
$user = new Utilisateur(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'mdp' => $_POST['mdp']
));

session_start();

try {

    $register = $bdd->getBdd()->prepare("SELECT * FROM utilisateur WHERE email = :email AND mdp = :mdp");
    $register->execute(array(
        'email'=>$user->getEmail(),
        'mdp'=>$user->getMdp()
    ));

    if (!$result = $register->fetch()) {

        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setEmail($_POST['email']);
        $user->setMdp($_POST['mdp']);
        $user->setAdmin(0);
        $user->setActif(0);
        $user->addUtilisateur($bdd);
        var_dump($user);

        // choiceBox
        if ($_POST['choix'] == "Représentant") {

            $rep = new Representant(array(
                'role' => $_POST['role'],
                'ref_hopital' => $_POST['hopital']
            ));

            $rep->setRole($_POST['role']);
            $rep->setRefHopital($_POST['hopital']);
            $rep->addRepresentant($bdd);

        } elseif ($_POST['choix'] == "Etudiant") {

            $etu = new Etudiant(array(
                'domaine' => $_POST['domain']
            ));

            $etu->setDomaine($_POST['domain']);
            $etu->addEtudiant($bdd);

        }
        echo "ok";
        header('Location: ../../vue/login.php');
    }else{
        //TODO: ajouter en html + js -> l'user a deja un compte
        header('Location: ../../vue/login.php');
    }

}catch(PDOException $e){
    echo $e;
}


