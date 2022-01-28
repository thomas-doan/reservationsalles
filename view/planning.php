<?php
require '../vendor/autoload.php';

use Controller\Planning;

// require_once(__DIR__ . '/../controller/Securite.php');
// require_once(__DIR__ . '/../controller/User.php');
// require_once(__DIR__ . '/../database/Database.php');
// require_once(__DIR__ . '/../controller/Toolbox.php');
// require_once(__DIR__ . '/../controller/Planning.php');
// require_once(__DIR__ . '/../model/Planning_model.php');
session_start();

$planning = new Planning();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/planning.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <title>Planning</title>
</head>

<body>
    <?php require('header_spe.php'); ?>
    <main>
        <p data-aos="fade-up" data-aos-duration="1500">Semaine du Lundi :
            <?php
            $planning->verification_semaine()
            ?>
        </p>
        <form action="" method="post" class="pagination">
            <button type="submit" name="moins" data-aos="fade-right" data-aos-duration="2000">-</button>
            <button type="submit" name="plus" data-aos="fade-left" data-aos-duration="2000">+</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $planning->afficher_planning()
                ?>
            </tbody>
        </table>
        <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
    </main>
    <?php require('footer_spe.php'); ?>
</body>
<script>
    AOS.init();
</script>

</html>