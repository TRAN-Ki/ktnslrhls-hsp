<?php
session_start();

if ($_POST['code'] == $_SESSION['rand']){


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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">

    <title>HSP - Template</title>

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
    </style>

</head>

<body>
<header class="p-3 bg-slate-200 border-gray-400 border-b-2">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="../index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                <p style="font-size: 24px; font-weight: bolder; margin-right: 25px">HSP</p>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

            </ul>

        </div>
    </div>
</header>
<div class="container">
    <div class="">
        <p>Réinitialisation du mot de passe</p>
        <br>
        <form action="../src/traitement/editmdp.php" onsubmit="return validateform()" method="post">
            <label>Entrez votre nouveau mot de passe :</label>
            <input type="text" name="mdp" id="id1" placeholder="nouveaumotdepasse" required>
            <label>Confirmez :</label>
            <input type="text" name="mdp1" id="id2" placeholder="nouveaumotdepasse" required>

                <button type="submit">Valider</button>
        </form>

    </div>
</div>
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">

        </ul>
        <p class="text-center text-muted">&copy;2002-2022 HSP</p>
    </footer>
</div>
</body>
<script>
function validateform(){
    var mdp1 = document.getElementById('id1').value;
    var mdp2 = document.getElementById('id2').value;
    if (mdp1 !== mdp2){
        alert('Les mots de passes ne correspondent pas !');
        console.log(mdp2,mdp1);
        return false;
    }else{
        alert('Votre mot de passe a bien été modifier !');
        return true;
    }
}

</script>
</html>
<?php }else{

    header('Location: ../src/traitement/mdp-oublie.php');

} ?>