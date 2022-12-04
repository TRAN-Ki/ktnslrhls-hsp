<?php

require_once '../../src/bdd/Database.php';
require_once '../modele/Utilisateur.php';

session_start();

$bdd = new Database();
$user = new Utilisateur(array(
    'email' =>$_SESSION['email']
));

$result = $user->selectUserMdpOublie($bdd);


if($result){

    $hash = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

    $user1 = new Utilisateur(array(
        'id'=>$result['id_utilisateur'],
        'nom'=>$result['nom'],
        'prenom'=>$result['prenom'],
        'email' =>$result['email'],
        'mdp'=>$hash,
        'admin'=>$result['admin'],
        'actif'=>$result['actif']
    ));

    $user1->updateUtilisateurAndPassword($bdd);

    ?>
<script>

    close();

</script>
    <?php
}
    ?>
