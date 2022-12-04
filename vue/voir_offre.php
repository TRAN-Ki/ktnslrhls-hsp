<?php
require_once '../src/bdd/Database.php';
require_once '../src/modele/Offre.php';
require_once '../src/modele/Type.php';
require_once '../src/modele/Postule.php';
session_start();
$bdd = new Database();
if (isset($_POST['id'])){
    $offre = new Offre(array(
        'id'=>$_POST['id']
    ));
    $res = $offre->selectOffreById($bdd);
    $_SESSION['current_offre'] = $_POST['id'];
}
else{
    $offre = new Offre(array(
        'id'=>$_SESSION['current_offre']
    ));
    $res = $offre->selectOffreById($bdd);
}
?>
<!DOCTYPE html>
<html lang="FR">

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

    <title>HSP - Voir l'offre</title>

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
<?php
if (isset($_SESSION['e'])){
    if ($_SESSION['e'] == "errorInsert"){
        ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Erreur !</strong> Tu n'as pas pu postuler à l'offre. Contact un administrateur si l'erreur se reproduit.
        </div>
        <?php
        unset($_SESSION['e']);
    }
}

if (isset($_SESSION['e'])){
    if ($_SESSION['e'] == "sucessInsert"){
        ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Succès !</strong> Votre postulation a été prise en compte ! Garder un oeil sur votre boîte mail !
        </div>
        <?php
        unset($_SESSION['e']);
    }
}
?>
<header class="mb-4r">
    <nav class="navbar fixed-top navbar-expand-lg border-bottom border-3" style="background-color: #F8F8FF">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HSP</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link px-2" href="../index.php">Accueil</a></li>
                <li class="nav-item"><a href="../src/traitement/deconnexion.php" class="nav-link px-2">Se déconnecter</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="container mx-auto px-32">
    <div>
        <h1 class="mt-8"><strong>Offre : </strong><i><?php echo $res['libelle'] ?></i></h1>
    </div>
    <h6>Description de l'offre ↴ </h6>
    <textarea class="mb-2" cols="50" rows="8" disabled><?php echo $res['description']?></textarea>
    <?php
    $type = new Type(array(
        'id'=>$res['ref_type']
    ));
    $bdd = new Database();
    $res_type = $type->selectTypeById($bdd);
    ?>
    <h6>Type d'offre ↴</h6>
    <input class="mb-2" type="text" value="<?php echo $res_type['libelle'] ?>" disabled>
    <form action="../src/traitement/postule.php" method="post">
        <?php
        $postule = new Postule(array(
            'RefEtudiant'=>$_SESSION['id'],
            'RefOffre'=>$res['id_offre']
        ));
        $result = $postule->selectPostuleByRef($bdd);
        ?>
        <input type="submit" <?php if ($result){ ?> disabled value="Déjà postulé" <?php } else{ ?> value="Postuler" <?php }?> >
    </form>
</div>
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        </ul>
        <p class="text-center text-muted">&copy;2002-2022 HSP</p>
    </footer>
</div>
</body>

</html>
