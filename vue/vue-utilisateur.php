<?php
//interface utilisateur
require_once '../src/modele/Utilisateur.php';
require_once '../src/bdd/Database.php';


session_start();
$_SESSION['email'] = "g.brusson@lprs.fr";
if(!isset($_SESSION['email'])){
    header("Location: ../index.php");
}
$bdd = new Database();
$user = new Utilisateur(array(
    'email'=>$_SESSION['email']

));
var_dump($_SESSION);
$res = $user->selectUtilisateurByEmail($bdd);
var_dump($res);
?>
<form id="form" action="../src/traitement/traitement-register.php" method="post">

<label>Email</label>
<input type="email" name="email" required>
<br><br>
<label>Mot de passe</label>
<input type="password" name="mdp" required>
<br><br>
    <input type="submit">
</form>
