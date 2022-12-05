<?php

require_once '../../src/bdd/Database.php';
require_once '../modele/Utilisateur.php';

session_start();
var_dump($_SESSION);
$bdd = new Database();
if (isset($_SESSION['email']) || isset($_SESSION['emailAdmin'])){
    if ($_POST['email'] == $_SESSION['email']){
        $user = new Utilisateur(array(
            'email' =>$_SESSION['email']
        ));

        $result = $user->selectUserMdpOublie($bdd);
    }
    if ($_POST['email'] == $_SESSION['emailAdmin']){
        $user = new Utilisateur(array(
            'email' =>$_SESSION['emailAdmin']
        ));

        $result = $user->selectUserMdpOublie($bdd);
    }
    else{
        $result = false;
    }
}
else{
    $result = false;
}

var_dump($user);
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
var_dump($user1);
header('Location: ../../vue/vue-utilisateur.php');
?>
