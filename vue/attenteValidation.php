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
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>HSP - Attente de validation</title>

    <style>

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

        body {
            background-color: #fcfcfc;
            background-image:  linear-gradient(135deg, #f8f8ff 25%, transparent 25%), linear-gradient(225deg, #f8f8ff 25%, transparent 25%), linear-gradient(45deg, #f8f8ff 25%, transparent 25%), linear-gradient(315deg, #f8f8ff 25%, #fcfcfc 25%);
            background-position:  40px 0, 40px 0, 0 0, 0 0;
            background-size: 80px 80px;
            background-repeat: repeat;
        }

        a.back {
            color: #0a53bd !important;
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
                <li><a href="../index.php" class="nav-link px-2">Accueil</a></li>
            </ul>

            <div class="text-end">
                <a href="../index.php">
                    <button class="btn btn-primary btn-sm">Retour à l'accueil</button>
                </a>
            </div>
        </div>
    </div>
</header>
<div class="container mx-auto px-32">
    <div>
        <br>
        <p><a class="back" href="../index.php">Retour à l'accueil</a></p>
        <p>Votre compte n'est pas encore validé / n'est pas actuellement actif.</p><br>
        <p>Un compte est généralement activé au bout de 3-4 jours.</p><br>
        <p>En cas de problème(s) avec l'activation de votre compte, veuillez contacter un administrateur.</p><br>
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

</html>