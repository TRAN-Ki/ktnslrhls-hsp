<?php

require_once '../bdd/Database.php';
require_once '../modele/Utilisateur.php';
require_once '../modele/Etudiant.php';
require_once '../modele/Representant.php';
require_once '../modele/Mail.php';

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

        // choiceBox // à revoir pour la sécurité
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
                'domaine' => $_POST['domaine']
            ));

            $etu->setDomaine($_POST['domaine']);
            $etu->addEtudiant($bdd);

        }

        $email = $user->getEmail();
        $prenom = $user->getPrenom();

        $mail = new Mail($prenom,$email);

        $mail->sendMail('Inscription HSP','Bonjour '.$prenom.', <br><br> Votre inscription a bien été pris en compte par notre administration. <br> Vous serez recontacté dans les plus brefs délais. <br><br> Bien cordialement,');

        echo "ok";
        header('Location: ../../index.php');
    }else{
        //TODO: ajouter en html + js -> l'user a deja un compte
        header('Location: ../../index.php');
    }

}catch(PDOException $e){
    echo $e;
}


