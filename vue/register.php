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
        <?php
            require_once '../src/bdd/Database.php';

            $bdd = new Database();

            $req = $bdd->getBdd()->prepare("SELECT role FROM representant");
            $req->execute();
            while ($res = $req->fetch()){
        ?>
        <option><?php echo $res['role'] ?></option>
        <?php } ?>
    </select>
    <br>
    <select name="domaine" class="etudiant">
        <?php
        $request = $bdd->getBdd()->prepare("SELECT domaine FROM etudiant");
        $request->execute();
        while ($result = $request->fetch()){ ?>
        <option><?php echo $result['domaine'] ?></option>
        <?php } ?>
    </select>

    <button type="submit">Valider</button>

</form>

</body>
<script>
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