<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';

$bdd = new Database();

$user = new Utilisateur(); /** **/
$rep = new Representant(); /** parametre hydrate **/
$etu = new Etudiant(); /** **/

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
        // choiceBox
        if ($_POST['choix'] == "représentant") {
            $rep->setRole($_POST['role']);
            $rep->setRefHopital($_POST['hopital']);
            $rep->addRepresentant($bdd);

        } elseif ($_POST['choix'] == "etudiant") {
            $etu->setDomaine($_POST['domain']);
            $etu->addEtudiant($bdd);

        }
        header('Location: ../../vue/attenteValidation.php');
    }else{
        header('Location: ../../vue/register.php');
    }

}catch(PDOException $e){
    echo $e;
}


