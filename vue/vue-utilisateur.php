<?php
//interface utilisateur
require_once '../src/modele/Utilisateur.php';
require_once '../src/bdd/Database.php';
require_once '../src/modele/Offre.php';

session_start();
$_SESSION['isRepr'] = 1;
if (!isset($_SESSION['isAdmin'])){
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
    }
}
if (isset($_SESSION['email'])){
    $bdd = new Database();
    $user = new Utilisateur(array(
        'email'=>$_SESSION['email']
    ));
    $res = $user->selectUtilisateurByEmail($bdd);
//var_dump($res);
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
            crossorigin="anonymous"></script>
<!--    <link rel="stylesheet" href="assets/css/styles.css">-->
    <title>Espace Utilisateur</title>
    <style>
        .main-page {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            color: #0a53bd;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }
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
                <a class="navbar-brand" href="#">Navbar</a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
                        <li class="nav-item"><a href="../src/traitement/deconnexion.php" class="nav-link px-2">Se déconnecter</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <?php
        if (isset($_SESSION['isAdmin'])){
            if ($_SESSION['isAdmin'] == 1){ ?>
                <div>
                    <h1 class="mt-8">Espace Admin</h1>
                    Accéder à l'espace administrateur <a href="panelAdmin/homeAdmin.php">ici</a>.
                    <hr>
                </div>
                <?php
            }
        }
        ?>
        <div>
            <h1 class="mt-8">Espace Utilisateur</h1>
        </div>
        <!-- Modification utilsateur -->
        <div>
            <form id="form" action="../src/traitement/traitement-register.php" method="post">
                <h4>Modifier son profil :</h4>
                <div class="label"></div>
                <h6>Email :</h6>
                <input type="email" name="email" placeholder="example@domain.org" required> <br><br>
                <h6>Mot de passe :</h6>
                <input type="password" name="mdp" required placeholder="Mot de passe"> <br><br>
                <input type="submit" value="Modifier">
            </form>
        </div>
        <div>
            <form id="form" action="" method="post">
                <h4>Modifier son profil :</h4>
                <h6>Email :</h6>
                <input type="email" name="email" placeholder="example@domain.org" required> <br><br>
                <h6>Mot de passe :</h6>
                <input type="password" name="mdp" required placeholder="Mot de passe"> <br><br>
                <input type="submit" value="Modifier">
            </form>
        </div>
        <div>
            <h4>Voir les offres :</h4>
            <?php


            $liste = new Offre(array());
            $bdd = new Database();
            $res = $liste->selectOffre($bdd);
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#table').DataTable()
                });
            </script>
            <table id="table" class="display" style="width:100%"></table>
            <form action="" method="post">

            </form>
        </div>
        <!--Un hôpital peut également créer des offres d’emplois et les mettre à disposition des étudiants inscrit sur la plateforme.
        Une offre est décrite par le titre de l’offre une description de l’offre et le type de contrat.
        Chaque étudiant peut venir postuler à cette offre et les hôpitaux peuvent consulter les différents étudiant ayant postulé à cette offre.
        A la suite de cela, une entreprise peut proposer des rendez-vous à certain étudiant.
        Sur ce rendez-vous, il y sera décrit la date, l’heure et on y retrouvera l’offre proposé par l’entreprise.
        Un étudiant doit confirmer le rendez-vous proposé par l’entreprise.
        La gestion des types d’offre et des salles sont faites par les administrateurs.
        Les administrateurs ne sont pas des représentant des hôpitaux ou des étudiants.
        A la validation (ou non) d’un rendez-vous ou la confirmation (ou non) de la création d’un évènement, un email devra être envoyé à la personne concernée.
        A la proposition d’un rendez-vous, un étudiant recevra un email lui invitant à confirmer sa disponibilité.-->
        <hr>
        <!-- TODO: if "représentant" = afficher ce bloc" -->
        <div>
            <h1 class="mt-8">Espace Représentant</h1>
        </div>
        <div>
            <form action="" method="post">
                <h4>Créer une offre :</h4>
                <div class="label"></div>
                <h6>Libelle :</h6>
                <input type="text" name="libelle" placeholder="Titre de l'offre" required> <br><br>
                <h6>Description :</h6>
                <input type="text" name="description" placeholder="Description de l'offre" required> <br><br>
                <!-- TODO: ajouter dans bdd colonne ref_type + lier ici -->
                <select name="" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <input type="submit" value="Créer">
            </form>
        </div>
    </div>


</body>
</html>
<?php
var_dump($_SESSION);

