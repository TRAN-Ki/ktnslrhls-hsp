<?php
require_once '../../src/modele/Utilisateur.php';
session_start();
if(!isset($_SESSION['isAdmin'])){
    header("Location: ../../index.php");
}
else if($_SESSION['isAdmin'] == 0){
    header("Location: ../../index.php");
}

else if ($_SESSION['isAdmin'] == 1){
    /*
        // Menu Actif

            // <select user>
            if (isset($_POST['admin'])){
                echo "dsqds";
                $user = new Utilisateur(array(
                    'admin' => $_POST['admin'],
                    'actif' => $_POST['actif']

                ));
            }

            // Pour attribué à un utilisateur le role admin
            if($_POST['admin'] = 'Administrateur') {
                $user->setAdmin(1);
            }
            // Pour validé un utilisateur qui a créé un compte (validé inscriptions)
            if($_POST['actif'] = 'Vérifié') {
                $user->setActif(1);
            } */
      ?>
        <!DOCTYPE html>
        <html lang="FR">

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
                    crossorigin="anonymous"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
                  rel="stylesheet">

            <link rel="stylesheet" href="../../assets/css/styles.css">

            <title>HSP - Accueil</title>

            <style>
                .main-page {
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 500;
                    color: #0a53bd;
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-evenly;
                }

                .box-1 {
                    border: 2px solid;
                    padding: 8px 16px;
                    border-radius: 5px;
                }

                .break {
                    flex-basis: 100%;
                    height: 0;
                }
            </style>

            <style>
                /* Footer */

            .bi {
                vertical-align: -.125em;
                fill: currentColor;
            }

            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }

            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .accueil-img {
                width: 50%;
                height: 50%;
            }

            body {
                background-color: #fcfcfc;
                background-image:  linear-gradient(135deg, #f8f8ff 25%, transparent 25%), linear-gradient(225deg, #f8f8ff 25%, transparent 25%), linear-gradient(45deg, #f8f8ff 25%, transparent 25%), linear-gradient(315deg, #f8f8ff 25%, #fcfcfc 25%);
                background-position:  40px 0, 40px 0, 0 0, 0 0;
                background-size: 80px 80px;
                background-repeat: repeat;
            }

                .alert {
                    padding: 20px;
                    background-color: #8ef85d;
                    color: white;
                    margin: 2px;
                }

                .closebtn {
                    margin-left: 15px;
                    color: white;
                    font-weight: bold;
                    float: right;
                    font-size: 22px;
                    line-height: 20px;
                    cursor: pointer;
                    transition: 0.3s;
                }

                .closebtn:hover {
                    color: black;
                }
        </style>

    </head>

    <body>
    <!--TODO: Faire les liens + refaire header session-->
    <header class="p-3 bg-slate-200 border-gray-400 border-b-2">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <p style="font-size: 24px; font-weight: bolder; margin-right: 25px">HSP</p>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2">FAQ Admin</a></li>
                    <li><a href="../../src/traitement/deconnexion.php" class="nav-link px-2">Déconnexion</a></li>
                </ul>

                <div class="text-end">
                    <a href="conference.php">
                        <button class="btn btn-secondary btn-sm">Gestion "Conférences"</button>
                    </a>
                    <a href="hopital.php">
                        <button class="btn btn-secondary btn-sm">Gestion "Hôpitaux"</button>
                    </a>
                    <a href="amphitheatre.php">
                        <button class="btn btn-secondary btn-sm">Gestion "Amphithéâtres"</button>
                    </a>
                    <a href="type.php">
                        <button class="btn btn-secondary btn-sm">Gestion "Types"</button>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="container mx-auto px-32">
        <?php

        if (isset($_SESSION['e'])){
            if ($_SESSION['e'] == "sucess"){
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Succès !</strong> Vous êtes connecté !
                </div>
                <?php
                unset($_SESSION['e']);
            }
        }

        ?>
        <div class="main-page">
            <div class="box-1 my-8 bg-slate-300 border-gray-400">
                Bienvenue sur le site HSP Étudiant
            </div>
            <div class="break"></div>
            <div class="box-1 my-8 bg-slate-300 border-gray-400">
                Voulez-vous gérer des utilisateurs ?
                <a href="utilisateur.php"><button class="btn btn-secondary btn-sm">Gestion "Utilisateur"</button></a>
            </div>
            <div class="box-1 my-8 bg-slate-300 border-gray-400">
                Autres fonctionnalités "Admin" ➜
                <a href="../vue-utilisateur.php"><button class="btn btn-secondary btn-sm">Panel Admin</button></a>
            </div>
            <div class="break"></div>
            <img class="rounded-lg accueil-img" src="../../assets/images/adminMain.jpg" alt="">
            <div class="break"></div>
        </div>
    </div>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Accueil</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQ</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">À propos</a></li>
            </ul>
            <p class="text-center text-muted">&copy;2002-2022 HSP</p>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>
    </body>
    </html>

<?php
}
else{
    echo "Erreur, retour à l'accueil automatique dans quelques secondes..";
    sleep(3);
    header("Location: ../../index.php");
}
?>


