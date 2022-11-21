<?php

require_once '../../src/bdd/Database.php';
require_once '../modele/Utilisateur.php';

session_start();

$bdd = new Database();
$user = new Utilisateur(array(
    'email' =>$_SESSION['email']
));

$result = $user->selectUserMdpOublie($bdd,$_SESSION['email']);

var_dump($result);

if($result){

    $user->setId($result['id_utilisateur']);
    $user->setNom($result['nom']);
    $user->setPrenom($result['prenom']);
    $user->setActif($result['actif']);
    $user->setAdmin($result['admin']);
    $user->setMdp($_POST['mdp']);
    $user->updateUtilisateur();

    ?>
<script>

    close();

</script>
    <?php

}

    ?>
