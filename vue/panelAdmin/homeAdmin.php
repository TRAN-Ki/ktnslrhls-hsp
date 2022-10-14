<?php

session_start();
if($_SESSION['admin'] == 0){
    header("Location: ../index.php");
}
else{

    // Menu Actif

    // <select user>
    $user = new Utilisateur(array(
            'admin' => $_POST['admin'],
            'actif' => $_POST['actif']

    ));
    // Pour attribué à un utilisateur le role admin
    if($_POST['admin'] = 'Administrateur') {
        $user->setAdmin(1);
    }
    // Pour validé un utilisateur qui a créé un compte (validé inscriptions)
    if($_POST['actif'] = 'Vérifié') {
        $user->setActif(1);
    }
  ?>



    //html

<?php
}

?>


