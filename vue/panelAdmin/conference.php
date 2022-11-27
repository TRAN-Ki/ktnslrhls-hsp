<?php
require_once '../../src/bdd/Database.php';
require_once '../../src/modele/Amphitheatre.php';
require_once '../../src/modele/Conference.php';


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
<div class="container">
    <div class="content">
        <h1><strong><i>Gérer les conférences</i></strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="homeAdmin.php"><button class="btn btn-secondary" type="button">Retour</button></a></h1>
        <hr>
        <hr>
        <h2><strong>Conférences :</strong></h2>
        <h3>Ajout d'une conférence : </h3>

        <form action="../../src/traitement/add_conference.php" method="post">
            <h6>Nom : </h6>
            <input type="text" name="nom" placeholder="Nom de la conférence"> <br><br>
            <h6>Description : </h6>
            <input type="text" name="desc" placeholder="Description de la conférence"> <br><br>
            <h6>Date : </h6>
            <input type="date" name="date" placeholder="Date de la conférence"> <br><br>
            <h6>Heure : </h6>
            <input type="number" name="heure" placeholder="Heure de début de la conférence"> <br><br>
            <h6>Durée : </h6>
            <input type="number" name="duree" placeholder="En minutes"> <br><br>
            <h6>Valider : </h6>
            <input type="number" name="valider" placeholder="(0 ou 1)"> <br><br>
            <h6>Reférence de l'amphitheatre :</h6>
            <?php

            $bdd = new Database();
            $amphi = new Amphitheatre(array());

            $result = $amphi->selectAmphitheatre($bdd);

            ?>
            <select name="ref">
                <option value="<?php echo $result[0]['id_amphitheatre'] ?>"><?php echo $result[0]['id_amphitheatre'].' - '.$result[0]['libelle']; ?></option>
            </select> <br><br>
            <input type="submit" value="Ajouter">
        </form>
        <br><br>
        <h3>Liste des Conférences :</h3>
        <?php

        $conf = new Conference(array());
        $bdd = new Database();
        $res = $conf->selectConference($bdd);
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
                <th>Valider</th>
                <th>Reference amphithéatre</th>
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
                    <td><?php echo $value['valider'];?></td>
                    <td><?php echo $value['ref_amphitheatre'];?></td>
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
                <th>Valider</th>
                <th>Reference amphithéatre</th>
            </tr>
            </tfoot>
        </table>
        <br> <br>
        <form action="../../src/traitement/delete_conference.php" method="post">
            <br>
            <h3>Supprimer des conférences : </h3>
            <p>Grâce à l'identifiant de la conférence, supprimez le.</p>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_conference'] ?>">Conférence n°<?php echo $value['id_conference'];?></option>
                    <?php
                }
                ?>
            </select>
            <br><br>
            <input type="submit">
        </form>
        <br><br>
    </div>
    <br>
    <div>
        <br>
        <h3>Modification d'une conférence : </h3>
        <form action="../../src/traitement/edit_conference.php" method="post">
            <strong><p>Grâce à l'identifiant de la conférence, selectionner l'amphitheatre à modifier</p></strong>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_conference']  ?>">Conférence n°<?php echo $value['id_conference'];?></option>
                    <?php
                }
                ?>
            </select>
            <br><br>
            <strong><p>Changer les valeurs à modifier : </p></strong>

            <h6>Nom : </h6>
            <input type="text" name="nom" placeholder="Nom de la conférence"> <br><br>
            <h6>Description : </h6>
            <input type="text" name="desc" placeholder="Description de la conférence"> <br><br>
            <h6>Date : </h6>
            <input type="date" name="date" placeholder="Date de la conférence"> <br><br>
            <h6>Heure : </h6>
            <input type="number" name="heure" placeholder="Heure de début de la conférence"> <br><br>
            <h6>Durée : </h6>
            <input type="number" name="duree" placeholder="En minutes"> <br><br>
            <h6>Valider : </h6>
            <input type="number" name="valider" placeholder="(0 ou 1)"> <br><br>
            <h6>Reférence de l'amphitheatre :</h6>
            <select name="ref">
                <option value="<?php echo $result[0]['id_amphitheatre'] ?>"><?php echo $result[0]['id_amphitheatre'].' - '.$result[0]['libelle']; ?></option>
            </select> <br><br>
            <input type="submit" value="Modifier">
        </form>
    </div>
</div>
<br><br>
</body>

