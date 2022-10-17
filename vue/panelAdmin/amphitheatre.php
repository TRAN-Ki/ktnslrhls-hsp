<?php
require_once '../../src/bdd/Database.php';
require_once '../../src/modele/Amphitheatre.php';
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

    <title>Gestion des amphitheatre</title>
</head>

<body>
<div class="container">
    <div class="content">
        <h1><strong><i>Gérer les amphitheatre</i></strong></h1>
        <hr>
        <hr>
        <h2><strong>Amphitheatre :</strong></h2>
        <h3>Ajout d'un amphitheatre : </h3>

        <form action="../../src/traitement/add_amphitheatre.php" method="post">
            <h6>Nom : </h6>
            <input type="text" name="libelle" placeholder="Nom de l'amphitheatre"> <br><br>
            <h6>Nombre de places :</h6>
            <input type="text" name="nbrplaces" placeholder="Nombre de places de l'amphitheatre"> <br><br>
            <input type="submit" value="Ajouter">
        </form>
        <br><br>
        <h3>Liste des amphitheatres :</h3>
        <?php

        $liste = new Amphitheatre(array());
        $bdd = new Database();
        $res = $liste->selectAmphitheatre($bdd);
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
                <th>Nom de l'amphitheatre</th>
                <th>Nombre de places</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value){ ?>
                <tr>
                    <td><?php echo $value['id_amphitheatre'];?></td>
                    <td><?php echo $value['libelle'];?></td>
                    <td><?php echo $value['nb_places'];?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Nom de l'amphitheatre</th>
                <th>Nombre de places</th>
            </tr>
            </tfoot>
        </table>
        <br> <br>
        <form action="../../src/traitement/delete_amphitheatre.php" method="post">
            <br>
            <h3>Supprimer des amphitheatres : </h3>
            <p>Grâce à l'identifiant de l'amphitheatre, supprimez le.</p>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_amphitheatre'] ?>">Amphitheatre n°<?php echo $value['id_amphitheatre'];?></option>
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
        <h3>Modification d'un amphitheatre : </h3>
        <form action="../../src/traitement/edit_amphitheatre.php" method="post">
            <strong><p>Grâce à l'identifiant de l'amphitheatre, selectionner l'amphitheatre à modifier</p></strong>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_amphitheatre']  ?>">Amphiteatre n°<?php echo $value['id_amphitheatre'];?></option>
                    <?php
                }
                ?>
            </select>
            <br><br>
            <strong><p>Changer les valeurs à modifier : </p></strong>

            <h6>Nom : </h6>
            <input type="text" name="libelle" placeholder="Nom de l'amphitheatre"> <br><br>
            <h6>Nombre de places :</h6>
            <input type="text" name="nbplaces" placeholder="Nombre de places"> <br><br>
            <input type="submit" value="Modifier">
        </form>
    </div>
</div>

</body>

