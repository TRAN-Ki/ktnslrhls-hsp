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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>

<form id="form" action="../src/traitement/traitement-register.php" method="post">

    <label>Nom</label>
    <input type="text" name="nom" required>
    <br><br>
    <label>Prénom</label>
    <input type="text" name="prenom" required>
    <br><br>
    <label>Email</label>
    <input type="email" name="email" required>
    <br><br>
    <label>Mot de passe</label>
    <input type="password" name="mdp" required>
    <br><br>
    <label>Choix du role</label>
    <input class="repr" type="radio" value="Représentant" name="choix" required>Représentant
    <input class="etud" type="radio" value="Etudiant" name="choix" required>Etudiant
    <br><br>

    <select name="role" class="representant">
        <option value="Chirurgien">Chirurgien</option>
        <option value="Medecin">Medecin</option>
        <option value="Dentiste">Dentiste</option>
        <option value="Infirmier">Infirmier</option>
        <option value="Autre">Autre..</option>
    </select>
    <br>
    <select name="domaine" class="etudiant">
        <option value="Chirurgien">Infirmier</option>
        <option value="Medecin">Dentaire</option>
        <option value="Dentiste">Chirurgie</option>
        <option value="Infirmier">Dermatologie</option>
        <option value="Autre">Autre..</option>
    </select>

    <button type="submit">Valider</button>

</form>

</body>
<script>
    //TODO : à fix
    $(document).ready(function() {
        $(".etudiant").hide();
        $(".representant").hide();
    });

    $("#etud").click(function(){
        $(".etudiant").show();
        $(".representant").hide();
    });

    $("#repr").click(function(){
        $(".representant").show();
        $(".etudiant").hide();
    });
</script>
</html>