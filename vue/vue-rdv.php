<?php
//interface utilisateur
require_once '../src/modele/Utilisateur.php';
require_once '../src/bdd/Database.php';
require_once '../src/modele/Rdv.php';
session_start();

$bdd = new Database();
$rdv = new Rdv(array());
if (!isset($_SESSION['isAdmin'])){
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
    }
}
if (isset($_SESSION['email'])){

    $user = new Utilisateur(array(
        'email'=>$_SESSION['email']
    ));
    $res = $user->selectUtilisateurByEmail($bdd);
}
?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <title>Espace Utilisateur</title>
        <style>
            body {
                background-color: #fcfcfc;
                background-image:  linear-gradient(135deg, #f8f8ff 25%, transparent 25%), linear-gradient(225deg, #f8f8ff 25%, transparent 25%), linear-gradient(45deg, #f8f8ff 25%, transparent 25%), linear-gradient(315deg, #f8f8ff 25%, #fcfcfc 25%);
                background-position:  40px 0, 40px 0, 0 0, 0 0;
                background-size: 80px 80px;
                background-repeat: repeat;
            }
            .mb-4r{
                margin-bottom: 4rem !important;
            }
        </style>
    </head>
    <body>
    <header class="mb-4r">
        <nav class="navbar navbar-expand-lg fixed-top border-bottom border-3" style="background-color: #F8F8FF">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">HSP</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a href="../src/traitement/deconnexion.php" class="nav-link px-2">Se déconnecter</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <?php
        if (isset($_SESSION['isEtud'])){
            if ($_SESSION['isEtud'] == 1){
                ?>
        <div>
            <h1 class="mt-8">Espace RDV - Etudiant</h1>
        </div>



            <?php } }  ?>
        <?php
        if (isset($_SESSION['isRepr'])){
            if ($_SESSION['isRepr'] == 1){
                ?>
        <div>
            <h1 class="mt-8">Espace RDV - Représentant</h1>
        </div>



            <?php } }  ?>
    </div>
    </body>
    </html>
<?php
var_dump($_SESSION);

