<!DOCTYPE html>
<html lang="FR">
<?php
session_start();
if(isset($_SESSION['isAdmin']) || isset($_SESSION['id'])){
    header('Location: vue/vue-utilisateur.php');
}

?>

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

    <link rel="stylesheet" href="assets/css/styles.css">

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
            background-color: #92f784;
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
<header class="p-3 bg-slate-200 border-gray-400 border-b-2">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                <p style="font-size: 24px; font-weight: bolder; margin-right: 25px">HSP</p>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

            </ul>

            <div class="text-end">
                <button class="btn btn-primary btn-sm connexion">Connexion</button>
                <a href="vue/register.php">
                    <button class="btn btn-secondary btn-sm">Inscription</button>
                </a>
            </div>
        </div>
    </div>
</header>
<div class="container mx-auto px-32">
    <div class="main-page">
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
        ?>
        <div class="break"></div>
        <div class="box-1 my-8 bg-slate-300 border-gray-400">
            Bienvenue sur le site HSP ??tudiant
        </div>
        <div class="break"></div>
        <img class="rounded-lg accueil-img" src="assets/images/bg.jpg" alt="">
        <div class="break"></div>
        <div class="box-1 my-8 bg-slate-300 border-gray-400">
            Voulez-vous vous connecter ?
            <button class="btn btn-primary btn-sm connexion">Connexion</button>
        </div>
        <div class="box-1 my-8 bg-slate-300 border-gray-400">
            Voulez-vous vous inscrire ?
            <a href="vue/register.php"><button class="btn btn-secondary btn-sm">Inscription</button></a>
        </div>
    </div>
</div>
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="https://www.aphp.fr" class="nav-link px-2 text-muted">?? propos</a></li>
            <div class="break"></div>
            <li class="nav-item"><a class="nav-link px-2 text-muted connexion">Connexion</a></li>
            <li class="nav-item"><a href="vue/register.php" class="nav-link px-2 text-muted">Inscription</a></li>
        </ul>
        <p class="text-center text-muted">&copy;2002-2022 HSP</p>
    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

<script>
    $('.connexion').click(async function () {
        Swal.fire({
            title: 'Connexion',
            html: `<input type="email" id="login" class="swal2-input" placeholder="exemple@domaine.org">
            <input type="password" id="password" class="swal2-input" placeholder="Mot de passe"><br>
            <a target="_blank" href="vue/vue-mdp-oublie.php">Mot de passe oubli?? ? Clique ici.</a>`,
            confirmButtonText: 'Se connecter',
            focusConfirm: false,
            preConfirm: () => {
                const login = Swal.getPopup().querySelector('#login').value
                const password = Swal.getPopup().querySelector('#password').value
                if (!login || !password) {
                    Swal.showValidationMessage(`Entrer un mail et un mot de passe valide.`)
                }
                return {login: login, password: password}
            }
        }).then((result) => {
            var login = result.value.login;
            var mdp = result.value.password;
            console.log(login);
            console.log(mdp);
            $.ajax({
                type: "POST",
                url: "./src/traitement/traitement-login.php",
                data: {email: login, mdp: mdp},
                success: function (response){
                    console.log(response);
                    if (response === "oui") {
                        console.log("compte actif")
                        window.location.href = "vue/vue-utilisateur.php";
                    }
                    if (response === "non") {
                        console.log("compte non actif")
                        window.location.href = "vue/attenteValidation.php";
                    }
                    if (response === "admin") {
                        console.log("compte administrateur")
                        window.location.href = "vue/panelAdmin/homeAdmin.php";
                    }
                    else {
                        console.log("error")
                        Swal.fire(
                            'Erreur',
                            'Veuillez contacter un administrateur ou r??essayer',
                            'error'
                        )
                    }
                }
            });
        })

    });



</script>
</body>
</html>
