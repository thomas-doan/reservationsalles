<?php

require 'vendor/autoload.php';
use Controller\User;
use Controller\ReservationClass;
session_start();


if (isset($_SESSION['user'])) {
    $id_session = $_SESSION['user']['id'];
    $_SESSION['objet_utilisateur'] = new User($id_session);
    $_SESSION['objet_reservation'] = new ReservationClass($id_session);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./public/css/index.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <link rel="stylesheet" href="./public/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <title>Accueil</title>
</head>

<body>
    <?php require('./view/header.php'); ?>
    <main>
        <div class=" container_index">
            <?php require_once(__DIR__ . '/view/gestion_erreur.php'); ?>
            <section class="section-img">
                <div id="sport" class="section_modal">
                    <div class="index_content">
                        <h1 data-aos="fade-up" data-aos-duration="3000">Sport</h1>
                    </div>
                    <div class="index_overlay"></div>
                </div>
                <div id="detente" class="section_modal">
                    <div class="index_content">
                        <h1 data-aos="fade-down" data-aos-duration="3000">Détente</h1>
                    </div>
                    <div class="index_overlay"></div>
                </div>
                <div id="travail" class="section_modal">
                    <div class="index_content">
                        <h1 data-aos="fade-up" data-aos-duration="3000">Travail</h1>
                    </div>
                    <div class="index_overlay"></div>
                </div>
                <div id="event" class="section_modal">
                    <div class="index_content">
                        <h1 data-aos="fade-down" data-aos-duration="3000">Évènements</h1>
                    </div>
                    <div class="index_overlay"></div>
                </div>
            </section>
            <section class="section-txt">
                <h2 data-aos="fade-right" data-aos-duration="3000">Bienvenue parmi nous <?php if (isset($_SESSION['user'])) {
                                                                                            echo $_SESSION['user']['login'];
                                                                                        } ?> !</h2>
                <p data-aos="fade-left" data-aos-duration="3000">Une envie d'un endroit où faire la fête, où travailler dans le calme, où organiser vos réunion ou encore
                    faire du sport ?
                    Eh bien vous tomber à pic !! Venez réserver une salle sur notre site pour profiter d'un espace
                    calme et conviviale pour votre plus grand bonheur. Pour réserver rien de plus simple connectez vous pour
                    réserver une salle, vous n'avez pas de compte ? Ce n'est pas grave inscrivez vous et par la suite vous pourrez
                    reserver votre salle. Choisissez la date, l'heure, donner un titre et une description à votre créneau et une
                    salle vous sera decerné. <a href="./view/reservation-form.php"> Cliquez ICI</a> pour reserver une salle.</p>
            </section>
        </div>
    </main>
    <?php require('./view/footer.php'); ?>
    <script>
        AOS.init();
    </script>
</body>

</html>