<?php
require '../vendor/autoload.php';
session_start();

use Model\Register;
use Controller\Toolbox;
use Controller\Securite;


if (isset($_POST['inscription'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['Cpassword'])) {
        if ($_POST['password'] == $_POST['Cpassword']) {
            Register::register_utilisateur($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password']);
        } else {
            Toolbox::ajouterMessageAlerte("Mdp non identique", Toolbox::COULEUR_ROUGE);
        }
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
    }
}

if (Securite::estConnecte()) {
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../public/css/form.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Inscription</title>
</head>

<body>
    <?php require('header_spe.php'); ?>
    <main>

        <form action="" method="post">
            <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
            <input type="text" name="login" placeholder="Login" />
            <input type="text" name="prenom" placeholder="Prenom" autocomplete="off">
            <input type="text" name="nom" placeholder="Nom" autocomplete="off">
            <input type="text" name="email" placeholder="Email" autocomplete="off">
            <input type="password" name="password" placeholder="Mot de passe" />
            <input type="password" name="Cpassword" placeholder="Confirmez le mot de passe" />
            <button type="submit" name="inscription">Creer un compte</button>
            <p class="message">Vous avez déjà un compte ? <br><a class="aa" href="connexion.php">Connectez vous</a></p>
        </form>

    </main>
    <?php require('footer_spe.php'); ?>
</body>

</html>