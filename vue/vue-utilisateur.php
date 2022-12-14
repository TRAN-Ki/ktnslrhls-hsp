<?php
//interface utilisateur
require_once '../src/modele/Utilisateur.php';
require_once '../src/bdd/Database.php';
require_once '../src/modele/Offre.php';
require_once '../src/modele/Type.php';
require_once '../src/modele/Conference.php';
require_once '../src/modele/Inscrit.php';


session_start();

$bdd = new Database();
//$_SESSION['isEtud'] = 1;
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

        .alert {
            padding: 20px;
            background-color: #68ce6c;
            color: white;
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
    <header class="mb-4r">
        <nav class="navbar navbar-expand-lg fixed-top border-bottom border-3" style="background-color: #F8F8FF">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">HSP</a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
                        <li class="nav-item"><a href="../src/traitement/deconnexion.php" class="nav-link px-2">Se d??connecter</a></li>
                    </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <?php
        if (isset($_SESSION['e'])){
            if ($_SESSION['e'] == "error"){
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Erreur !</strong> Votre action n'a pas pu ??tre effectu??. Contact un administrateur si l'erreur se reproduit.
                </div>
                <?php
                unset($_SESSION['e']);
            }
        }

        if (isset($_SESSION['e'])){
            if ($_SESSION['e'] == "sucess"){
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Succ??s !</strong> Votre action a ??t?? prise en compte !
                </div>
                <?php
                unset($_SESSION['e']);
            }
        }

        if (isset($_SESSION['e'])){
            if ($_SESSION['e'] == "sucessConf"){
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Succ??s !</strong> Votre conf??rence a ??t?? enregistr??e ! Elle sera d'abord valid??e par un administrateur.
                </div>
                <?php
                unset($_SESSION['e']);
            }
        }
        ?>
        <?php
        if (isset($_SESSION['isAdmin'])){
            if ($_SESSION['isAdmin'] == 1){ ?>
                <div>
                    <h1 class="mt-8">Espace Admin</h1>
                    Acc??der ?? l'espace administrateur <a href="panelAdmin/homeAdmin.php">ici</a>.
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
            <form id="form" action="../src/traitement/editmdp_fromuser.php" method="post">
                <h4>Modifier son profil :</h4>
                <div class="label"></div>
                <h6>Email :</h6>
                <input type="email" name="email" placeholder="example@domain.org" required> <br><br>
                <h6>Entrez votre nouveau mot de passe :</h6>
                <input type="text" name="mdp" placeholder="Mot de passe" required> <br><br>
                <input type="submit" value="Modifier">
            </form>
        </div>
        <br>
        <div>
            <h4>Voir les conf??rences :</h4>
            <?php
            $conf = new Conference(array());
            $bdd = new Database();
            $res = $conf->selectConferenceUser($bdd);
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#table').DataTable();
                });
            </script>

            <table id="table" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la conf??rence</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Dur??e</th>
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
                        <td><?php if ($_SESSION['isEtud'] == 1){ ?>
                            <form action="../src/traitement/inscription-conf.php" method="post">
                                <button type="submit" name="validForm" value="<?php echo $value['id_conference']; ?>"><?php
                                    $ins = new Inscrit(array(
                                        'refetudiant'=>$_SESSION['id'],
                                        'refconference'=>$value['id_conference']
                                    ));
                                    $result = $ins->selectInscritRef($bdd);
                                    if ($result){
                                        echo "Se d??sinscrire";
                                    }
                                    if (!$result){
                                        echo "S'inscrire";
                                    } ?>
                                </button>
                            </form><?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nom de la conf??rence</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Dur??e</th>
                </tr>
                </tfoot>
            </table>
            <br>
            <?php
            if (isset($_SESSION['isRepr']) || isset($_SESSION['isEtud'])){
            if ($_SESSION['isRepr'] == 1 || $_SESSION['isEtud'] == 1){ ?>&nbsp;&nbsp;<a href="ajout_conference.php"><button>Ajouter</button></a>
            <?php }} ?>
        </div>
        <br>
        <?php
        if (isset($_SESSION['isEtud'])){
            if ($_SESSION['isEtud'] == 1){
        ?>
        <div>
            <hr>
            <div>
                <h1 class="mt-8">Espace Etudiant</h1>
            </div>
        </div>
        <br>
        <div>
            <h4>Voir les offres :</h4>
            <?php
            $liste = new Offre(array());
            $bdd = new Database();
            $res = $liste->selectOffre($bdd);
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#tableOffre').DataTable();
                });
            </script>
            <table id="tableOffre" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'offre</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Repr??sentant</th>
                    <th>Voir l'offre</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($res as $value){ ?>
                    <tr>
                        <td><?php echo $value['id_offre'];?></td>
                        <td><?php echo $value['libelle'];?></td>
                        <td><?php echo $value['description'];?></td>
                        <td><?php echo $value['ref_type'];?></td>
                        <td><?php echo $value['ref_representant'];?></td>
                        <td>
                            <form method="post" action="voir_offre.php">
                                <input name="id" value="<?php echo $value['id_offre']?>" type="text" style="display: none">
                                <input type="submit" value="Voir">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'offre</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Repr??sentant</th>
                    <th>Voir l'offre</th>
                </tr>
                </tfoot>
            </table>
        </div><br>
                <a href="vue-rdv.php"><button>Voir RDV</button></a>
        <?php
            } }
            if (isset($_SESSION['isRepr'])){
                if ($_SESSION['isRepr'] == 1){
                    ?>
        <div>
            <h1 class="mt-8">Espace Repr??sentant</h1>
        </div>
        <div>
            <form action="../src/traitement/add_offre.php" method="post">
                <h4>Cr??er une offre :</h4>
                <div class="label"></div>
                <h6>Libelle :</h6>
                <input type="text" name="libelle" placeholder="Titre de l'offre" required> <br><br>
                <h6>Description :</h6>
                <textarea id="description" name="description" placeholder="Description de l'offre" required rows="5" cols="33"></textarea> <br><br>
                <h6>Type :</h6>
                <select class="js2" name="ref_type" id="ref_type">
                    <?php
                    $liste = new Type(array());
                    $bdd = new Database();
                    $res = $liste->selectType($bdd);
                    foreach ($res as $value){
                        ?>
                        <option value="<?php echo $value['id_type'] ?>">Type : <?php echo $value['libelle'];?></option>
                        <?php
                    }
                    ?>
                </select>
                <br><br>
                <input type="submit" value="Cr??er">
            </form>
            <br>
            <a href="vue-rdv.php"><button>Voir RDV</button></a>
        </div>
        <?php
                }}
        ?>
    </div>
    <br>
</body>
</html>


