<?php
require '../vendor/autoload.php';

use Controller\Toolbox;
use Controller\Securite;

session_start();


//affiche les infos profil
if (isset($_SESSION['objet_utilisateur'])) {
    $objet_user_info = $_SESSION['objet_utilisateur']->info_user();
}

//modifier les infos profil
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email'])) {
        $_SESSION['objet_utilisateur']->modifier_profil_user($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['email']);
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
        header("Location: ./profil.php");
        exit();
    }
}

//modifier le password
if (isset($_POST['submit_modification_password'])) {
    if (!empty($_POST['password_ancien']) && !empty($_POST['password_nouveau']) && !empty($_POST['password_confirmation'])) {
        if ($_POST['password_nouveau'] == $_POST['password_confirmation']) {
            $_SESSION['objet_utilisateur']->modifier_profil_password($_POST['password_ancien'], $_POST['password_nouveau']);
        }

        if ($_POST['password_nouveau'] !== $_POST['password_confirmation']) {
            Toolbox::ajouterMessageAlerte("Mots de passe différents !", Toolbox::COULEUR_ROUGE);
            header("Location: ./profil.php");
            exit();
        }
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
        header("Location: ./profil.php");
        exit();
    }
}

if (!Securite::estConnecte()) {
    header('Location:../index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/profil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <title>Profil</title>
</head>

<body>
    <?php require('header_spe.php'); ?>
    <main>

        <section class="section_profil">
            <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
            <h2 data-aos="zoom-in-down" data-aos-duration="2000" data-aos-anchor-placement="top-center">Mon profil : </h2>
            <form action="profil.php" method="post" data-aos="zoom-out-up" data-aos-duration="2000" data-aos-anchor-placement="center">
                <label for="login"> Login </label>
                <input type="text" name="login" value="<?= $objet_user_info['login'] ?>" autocomplete="off">
                <label for="prenom"> Prenom </label>
                <input type="text" name="prenom" value="<?= $objet_user_info['prenom'] ?>" autocomplete="off">
                <label for="nom"> Nom </label>
                <input type="text" name="nom" value="<?= $objet_user_info['nom'] ?>" autocomplete="off">
                <label for="email"> Email </label>
                <input type="text" name="email" value="<?= $objet_user_info['email'] ?>" autocomplete="off">
                <button type="submit" name="submit">Modifier profil</button>
            </form>
            <form action="profil.php" method="post" data-aos="zoom-out-up" data-aos-duration="2500" data-aos-anchor-placement="center">
                <input type="password" name="password_ancien" value="" autocomplete="off" placeholder="Ancien mot de passe">
                <input type="password" name="password_nouveau" value="" autocomplete="off" placeholder="Nouveau mot de passe">
                <input type="password" name="password_confirmation" value="" autocomplete="off" placeholder="Confirmation mot de passe">
                <button type="submit" name="submit_modification_password">Modifier password</button>
            </form>
        </section>

    </main>
    <?php require('footer_spe.php'); ?>
</body>
<script>
    AOS.init();
</script>

</html>