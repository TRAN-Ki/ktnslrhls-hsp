<?php if (isset($_SESSION['inscription'])) {
session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<form id="form" action="../src/traitement/traitement-register.php" method="post">

    <label for="nom">Nom</label>
    <input id="nom" type="text" name="nom" required>
    <br>
    <label for="prenom">Prénom</label>
    <input id="prenom" type="text" name="prenom" required>
    <br>
    <label for="email">Email</label>
    <input id="email" type="email" name="email" required>
    <br>
    <label for="mdp">Mot de passe</label>
    <input id="mdp" type="password" name="mdp" required>
    <br>
    <label for="choix">Choix du role</label>
    <input type="radio" value="Représentant" id="choix" name="choix" required>Représentant
    <input type="radio" value="Etudiant" id="choix" name="choix" required>Etudiant
    <br>
    <select id="sel">
        <option value=""></option>
    </select>
    <button type="button" onclick="myFunction()">Valider</button>

</form>
<script>
    function myFunction() {

        var x = document.getElementById("sel");
        x.style.display = "none"
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }</script>
</body>
</html>