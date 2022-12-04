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
    'email' => $_POST['email']
));

session_start();

try {
    $res = $user->testRegister($bdd);

    if (!$res) {
        $hash = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
        $user->setMdp($hash);
        $user->setAdmin(0);
        $user->setActif(0);
        $user->addUtilisateur($bdd);

        $user1 = new Utilisateur(array(
            'email' => $_POST['email']
        ));

        $result = $user1->testLogin($bdd);
        if ($result){
            if ($_POST['choix'] == "Représentant") {

                $rep = new Representant(array(
                    'refutilisateur'=> $result['id_utilisateur'],
                    'role' => $_POST['role'],
                    'refhopital' => $_POST['ref_hopital']

                ));
                $rep->addRepresentant($bdd);

        } elseif ($_POST['choix'] == "Etudiant") {

                $etu = new Etudiant(array(
                    'refutilisateur' => $result['id_utilisateur'],
                    'domaine' => $_POST['domaine']
                ));
                $etu->addEtudiant($bdd);

            }

            $email = $user->getEmail();
            $prenom = $user->getPrenom();

            $mail = new Mail($prenom, $email);

            $mail->sendMail('Inscription HSP', 'Bonjour ' . $prenom . ', <br><br> Votre inscription a bien été pris en compte par notre administration. <br> Vous serez recontacté dans les plus brefs délais. <br><br> Bien cordialement,');

            echo "ok";

        }
        header('Location: ../../index.php');
    }else{
        //header('Location: ../../index.php');
    }

}catch(PDOException $e){
    echo $e;
}


