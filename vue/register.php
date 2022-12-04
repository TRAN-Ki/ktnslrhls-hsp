<?php if (isset($_SESSION['inscription'])) {
session_destroy();
}
require_once '../src/modele/Hopital.php';
require_once '../src/bdd/Database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HSP - Inscription</title>
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

    <style>
        body {
            background-color: #fcfcfc;
            background-image:  linear-gradient(135deg, #f8f8ff 25%, transparent 25%), linear-gradient(225deg, #f8f8ff 25%, transparent 25%), linear-gradient(45deg, #f8f8ff 25%, transparent 25%), linear-gradient(315deg, #f8f8ff 25%, #fcfcfc 25%);
            background-position:  40px 0, 40px 0, 0 0, 0 0;
            background-size: 80px 80px;
            background-repeat: repeat;
        }
        .mb-4r{
            margin-bottom: 5rem !important;
        }
    </style>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body>
<header class="mb-4r">
    <nav class="navbar fixed-top navbar-expand-lg border-bottom border-3" style="background-color: #F8F8FF">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HSP</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="container">
    <h2>Inscription : </h2>
    <form id="form" action="../src/traitement/traitement-register.php" method="post">
        <label>Nom :</label><br>
        <input type="text" name="nom" required>
        <br><br>
        <label>Prénom :</label><br>
        <input type="text" name="prenom" required>
        <br><br>
        <label>Email :</label><br>
        <input type="email" name="email" required>
        <br><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="mdp" required>
        <br><br>
        <label>Choix du role :</label><br>
        <input id="repr" type="radio" value="Représentant" name="choix" required> Représentant <br>
        <input id="etud" type="radio" value="Etudiant" name="choix" required> Etudiant
        <br><br>
        <select name="ref_hopital" class="refHopital">
            <?php

            $liste = new Hopital(array());
            $bdd = new Database();
            $res = $liste->selectHopital($bdd);
            foreach ($res as $value){
                ?>
                <option value="<?php echo $value['id_hopital'] ?>">Type : <?php echo $value['nom'];?></option>
                <?php
            }
            ?>
        </select>

        <select name="role" class="representant">
            <option value="Chirurgien">Chirurgien</option>
            <option value="Medecin">Medecin</option>
            <option value="Dentiste">Dentiste</option>
            <option value="Infirmier">Infirmier</option>
            <option value="Autre">Autre..</option>
        </select>


        <select name="domaine" class="etudiant">
            <option value="Chirurgien">Infirmier</option>
            <option value="Medecin">Dentaire</option>
            <option value="Dentiste">Chirurgie</option>
            <option value="Infirmier">Dermatologie</option>
            <option value="Autre">Autre..</option>
        </select>
        <br><br>
        <button type="submit">Valider</button>

    </form>

</div>
</body>
<script>
    $(document).ready(function() {
        $(".refHopital").hide();
        $(".etudiant").hide();
        $(".representant").hide();
    });

    $("#etud").click(function(){
        $(".refHopital").hide();
        $(".etudiant").show();
        $(".representant").hide();
    });

    $("#repr").click(function(){
        $(".refHopital").show();
        $(".representant").show();
        $(".etudiant").hide();
    });
</script>
</html>