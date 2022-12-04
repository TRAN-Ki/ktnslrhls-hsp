<?php
//interface utilisateur
require_once '../src/modele/Utilisateur.php';
require_once '../src/bdd/Database.php';
require_once '../src/modele/Rdv.php';
require_once '../src/modele/Etudiant.php';
require_once '../src/modele/Representant.php';
require_once '../src/modele/Offre.php';


session_start();

$bdd = new Database();
$rdv = new Rdv(array());
$etu = new Etudiant(array());
$repr = new Representant(array());
$offre = new Offre(array());
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
        <?php
        $rdv = new Rdv(array(
            'refetudiant'=>$_SESSION['id']
        ));
        $bdd = new Database();
        $res = $rdv->selectRdvEtu($bdd);
        ?><br>
                <h3>Affichage de mes rendez-vous</h3>
        <table id="table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Validation du RDV</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value){
                if ($value['etat'] != 1){
                    $_SESSION['idrdv'] = $value['id_rdv'];
                ?>
                <tr>
                    <td><?php echo $value['id_rdv'];?></td>
                    <td><?php echo $value['date_rdv'];?></td>
                    <td><?php echo $value['heure'];?></td>
                    <td><a href="../src/traitement/validation_rdv.php"><button>Valider</button></a></td>
                </tr>
            <?php } } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Validation du RDV</th>
            </tr>
            </tfoot>
        </table>
            <?php } }  ?>
        <?php
        if (isset($_SESSION['isRepr'])){
            if ($_SESSION['isRepr'] == 1){
                ?>
        <div>
            <h1 class="mt-8">Espace RDV - Représentant</h1>
        </div>
        <h3>Ajout d'un rendez-vous : </h3>

        <form action="../src/traitement/add_rdv.php" method="post">
            <h6>Date : </h6>
            <input type="date" name="dates" required> <br><br>
            <h6>Heure : </h6>
            <input type="time" name="heure" placeholder="HH:MM:SS" required> <br><br>
            <h6>Reférence Etudiant : </h6>
            <select name="refetu" required>
                <?php
                $etu1 = $etu->selectEtudiant($bdd);
                $repr1 = $repr->selectRepresentant($bdd);
                $offre1 = $offre->selectOffre($bdd);
                foreach ($etu1 as $val){ ?>
                    <option value="<?php echo $val['ref_utilisateur']; ?>"><?php echo $val['ref_utilisateur']; ?></option>
                <?php } ?>
            </select> <br><br>
            <h6>Reférence Représentant : </h6>
            <select name="refrep" required>
                <?php foreach ($repr1 as $val1){ ?>
                <option value="<?php echo $val1['ref_utilisateur']; ?>"><?php echo $val1['ref_utilisateur']; ?></option>
                <?php } ?>
            </select> <br><br>
            <h6>Reférence Offre :</h6>
            <select name="refoff" required>
                <?php foreach ($offre1 as $val2){ ?>
                <option value="<?php echo $val2['id_offre']; ?>"><?php echo $val2['id_offre']; ?></option>
                <?php } ?>
            </select> <br><br>
            <input type="submit" value="Ajouter">
        </form>
        <?php
        $rdv = new Rdv(array(
                'refrepresentant'=>$_SESSION['id']
        ));
        $bdd = new Database();
        $res = $rdv->selectRdv($bdd);
        ?>  <br>
            <h3>Affichage de mes rendez-vous</h3>
        <table id="table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Réference Etudiant</th>
                <th>Réference Représentant</th>
                <th>Réference Offre</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value){ ?>
                <tr>
                    <td><?php echo $value['id_rdv'];?></td>
                    <td><?php echo $value['date_rdv'];?></td>
                    <td><?php echo $value['heure'];?></td>
                    <td><?php echo $value['ref_etudiant'];?></td>
                    <td><?php echo $value['ref_representant'];?></td>
                    <td><?php echo $value['ref_offre'];?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Réference Etudiant</th>
                <th>Réference Représentant</th>
                <th>Réference Offre</th>
            </tr>
            </tfoot>
        </table>
                <br>
                <form action="../src/traitement/delete_rdv.php" method="post">
                    <br>
                    <h3>Supprimer un RDV : </h3>
                    <p>Grâce à l'identifiant du RDV, supprimez le.</p>
                    <select class="js2" name="id" id="id">
                        <?php
                        foreach ($res as $value){
                            ?>
                            <option value="<?php echo $value['id_rdv'] ?>">RDV n°<?php echo $value['id_rdv'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" value="Supprimer">
                </form>
                <br>
                <h3>Modification d'un RDV : </h3>
                <form action="../src/traitement/edit_rdv.php" method="post">
                    <strong><p>Grâce à l'identifiant du RDV, selectionner le RDV à modifier</p></strong>
                    <select class="js2" name="id" id="id">
                        <?php
                        foreach ($res as $value){
                            ?>
                            <option value="<?php echo $value['id_rdv']  ?>">RDV n°<?php echo $value['id_rdv'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <strong><p>Changer les valeurs à modifier : </p></strong>

                    <h6>Date : </h6>
                    <input type="date" name="dates"> <br><br>
                    <h6>Heure : </h6>
                    <input type="time" name="heure" placeholder="HH:MM:SS"> <br><br>
                    <h6>Etat : </h6>
                    <input type="number" name="etat" placeholder="0 ou 1 ou 2"> <br><br>
                    <h6>Reférence Etudiant : </h6>
                    <select name="refetu" required>
                        <?php
                        $etu1 = $etu->selectEtudiant($bdd);
                        $repr1 = $repr->selectRepresentant($bdd);
                        $offre1 = $offre->selectOffre($bdd);
                        foreach ($etu1 as $val){ ?>
                            <option value="<?php echo $val['ref_utilisateur']; ?>"><?php echo $val['ref_utilisateur']; ?></option>
                        <?php } ?>
                    </select> <br><br>
                    <h6>Reférence Représentant : </h6>
                    <select name="refrep" required>
                        <?php foreach ($repr1 as $val1){ ?>
                            <option value="<?php echo $val1['ref_utilisateur']; ?>"><?php echo $val1['ref_utilisateur']; ?></option>
                        <?php } ?>
                    </select> <br><br>
                    <h6>Reférence Offre :</h6>
                    <select name="refoff" required>
                        <?php foreach ($offre1 as $val2){ ?>
                            <option value="<?php echo $val2['id_offre']; ?>"><?php echo $val2['id_offre']; ?></option>
                        <?php } ?>
                    </select> <br><br>
                    <input type="submit" value="Modifier">
                </form>

            <?php } }  ?>
        <br>
    </div>
    </body>
    </html>
<?php
var_dump($_SESSION);

