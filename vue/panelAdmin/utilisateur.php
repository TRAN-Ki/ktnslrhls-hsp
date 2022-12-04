<?php
require_once '../../src/bdd/Database.php';
require_once '../../src/modele/Utilisateur.php';
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

    <title>Gestion des utilisateurs</title>

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
        <h1><strong><i>Gérer les utilisateurs</i></strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="homeAdmin.php"><button class="btn btn-secondary" type="button">Retour</button></a></h1>
        <hr>
        <hr>
        <h2><strong>Utilisateur :</strong></h2>
        <h3>Ajout d'un utilisateur : </h3>

        <form action="../../src/traitement/add_user.php" method="post">
            <h6>Nom : </h6>
            <input type="text" name="nom" placeholder="Nom de l'utilisateur" required> <br><br>
            <h6>Prénom :</h6>
            <input type="text" name="prenom" placeholder="Prenom de l'utilisateur" required> <br><br>
            <h6>Email :</h6>
            <input type="text" name="email" placeholder="Email de l'utilisateur" required> <br><br>
            <h6>Mot de passe :</h6>
            <input type="password" name="mdp" placeholder="Mot de passe de l'utilisateur" required> <br><br>
            <h6>Admin :</h6>
            <input type="radio" value="adm" name="choix" checked required><br><br>
            <input type="submit" value="Ajouter">
        </form>
        <br><br>
        <h3>Liste des utilisateurs :</h3>
        <?php

        $liste = new Utilisateur(array());
        $bdd = new Database();
        $res = $liste->selectUtilisateur($bdd);
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
                <th>Nom de l'utilisateur</th>
                <th>Prenom de l'utilisateur</th>
                <th>Email de l'utilisateur</th>
                <th>Mdp de l'utilisateur</th>
                <th>Admin</th>
                <th>Actif</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value){ ?>
                <tr>
                    <td><?php echo $value['id_utilisateur'];?></td>
                    <td><?php echo $value['nom'];?></td>
                    <td><?php echo $value['prenom'];?></td>
                    <td><?php echo $value['email'];?></td>
                    <td><?php echo $value['mdp'];?></td>
                    <td><?php echo $value['admin'];?></td>
                    <td><?php echo $value['actif'];?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Nom de l'utilisateur</th>
                <th>Prenom de l'utilisateur</th>
                <th>Email de l'utilisateur</th>
                <th>Mdp de l'utilisateur</th>
                <th>Admin</th>
                <th>Actif</th>
            </tr>
            </tfoot>
        </table>
        <br> <br>
        <form action="../../src/traitement/delete_user.php" method="post">
            <br>
            <h3>Supprimer des utilisateurs : </h3>
            <p>Grâce à l'identifiant de l'utilisateur, supprimez le.</p>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_utilisateur'] ?>">Utilisateur n°<?php echo $value['id_utilisateur'];?></option>
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
        <h3>Modification d'un Utilisateur : </h3>
        <form action="../../src/traitement/edit_user.php" method="post">
            <strong><p>Grâce à l'identifiant de l'utilisateur, selectionner l'utilisateur à modifier</p></strong>
            <select class="js2" name="id" id="id">
                <?php
                foreach ($res as $value){
                    ?>
                    <option value="<?php echo $value['id_utilisateur']  ?>">Utilisateur n°<?php echo $value['id_utilisateur'];?></option>
                    <?php
                }
                ?>
            </select>
            <br><br>
            <strong><p>Changer les valeurs à modifier : </p></strong>

            <h6>Nom : </h6>
            <input type="text" name="nom" placeholder="Nom de l'utilisateur"> <br><br>
            <h6>Prénom :</h6>
            <input type="text" name="prenom" placeholder="prénom de l'utilisateur"> <br><br>
            <h6>email :</h6>
            <input type="text" name="email" placeholder="email de l'utilisateur"> <br><br>
            <h6>Mot de Passe :</h6>
            <input type="text" name="mdp" placeholder="mot de passe de l'utilisateur"> <br><br>
            <h6>Admin :</h6>
            <input type="text" name="admin" placeholder="0 ou 1"> <br><br>
            <h6>Actif :</h6>
            <input type="text" name="actif" placeholder="0 ou 1"> <br><br>

            <input type="submit" value="Modifier">
        </form>
    </div>
</div>
<br><br>
</body>
</html>
