<?php
require_once '../src/bdd/Database.php';
require_once '../src/modele/Amphitheatre.php';
require_once '../src/modele/Conference.php';


session_start();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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

    <title>Gestion des conférences</title>

    <style>
        body {
            background-color: #fcfcfc;
            background-image:  linear-gradient(135deg, #f8f8ff 25%, transparent 25%), linear-gradient(225deg, #f8f8ff 25%, transparent 25%), linear-gradient(45deg, #f8f8ff 25%, transparent 25%), linear-gradient(315deg, #f8f8ff 25%, #fcfcfc 25%);
            background-position:  40px 0, 40px 0, 0 0, 0 0;
            background-size: 80px 80px;
            background-repeat: repeat;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top border-bottom border-3" style="background-color: #F8F8FF">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">HSP</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
            <li class="nav-item"><a href="../src/traitement/deconnexion.php" class="nav-link px-2">Se déconnecter</a></li>
        </ul>
    </div>
</nav>
<br>
<br>
<br>
<div class="container">
    <div class="content">

        <h1>Conférences</h1>
        <hr>
        <hr>
        <h3>Ajout d'une conférence : </h3><br>
        <?php

        $bdd = new Database();
        $conf = new Conference(array());
        $conf->setValider(0);

        ?>
        <form action="../src/traitement/add_conference_user.php" onsubmit="" method="post">
            <h6>Nom : </h6>
            <input type="text" name="nom" placeholder="Nom de la conférence" required> <br><br>
            <h6>Description : </h6>
            <input type="text" name="desc" placeholder="Description de la conférence" required> <br><br>
            <h6>Date : </h6>
            <input type="date" name="date" placeholder="Date de la conférence" required> <br><br>
            <h6>Heure de début : </h6>
            <select name="heure" required>
                <option value="8">8h</option>
                <option value="8.5">8h30</option>
                <option value="9">9h</option>
                <option value="9.5">9h30</option>
                <option value="10">10h</option>
                <ption value="10.5">10h30</ption>
                <option value="11">11h</option>
            </select><br><br>
            <h6>Durée : </h6>
            <select name="duree" required>
                <option value="30">30min</option>
                <option value="60">60min</option>
                <option value="90">90min</option>
                <option value="120">120min</option>
                <option value="150">150min</option>
                <option value="180">180min</option>
            </select><br><br>
            <input type="submit" value="Ajouter">
        </form>
        <br><br>
        <h3>Liste des Conférences :</h3>
        <?php

        $res = $conf->selectConferenceUser($bdd);
        ?>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#table').DataTable()
            } );
        </script>
        <table id="table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la conférence</th>
                <th>Description</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Durée</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value){ ?>
                <tr>
                    <td><?php echo $value['id_conference'];?></td>
                    <td><?php echo $value['nom'];?></td>
                    <td><?php echo $value['description'];?></td>
                    <td><?php echo $value['date_conf'];?></td>
                    <td><?php echo $value['heure'];?></td>
                    <td><?php echo $value['duree'];?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Nom de la conférence</th>
                <th>Description</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Durée</th>
            </tr>
            </tfoot>
        </table>

        <br><br>
    </div>
    <br>
</div>
<br><br>
</body>
</html>
