<?php
require '../vendor/autoload.php';

use Database\Database;
use Controller\Securite;
use Controller\ReservationClass;
// require_once(__DIR__ . '/../database/database.php');
// require_once(__DIR__ . '/../controller/Securite.php');
// require_once(__DIR__ . '/../controller/Toolbox.php');
// require_once(__DIR__ . '/../controller/ReservationClass.php');
session_start();

if (!Securite::estConnecte()) {
    header('Location:./connexion.php');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $currentPage = (int) strip_tags($_GET['id']);
} else {
    header('Location: ./planning.php');
}

$reservation = new ReservationClass($currentPage);
$resultat = $reservation->display_reservation($currentPage);

$datetimeStart = new \DateTime($resultat['debut']);
$datetimeEnd = new \DateTime($resultat['fin']);
$datetimeStartDay = date_format($datetimeStart, 'j/n/o');
$datetimeStartHour = date_format($datetimeStart, 'G');
$datetimeEndHour = date_format($datetimeEnd, 'G');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/reservation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Evenement</title>
</head>

<body>
    <?php require('header_spe.php'); ?>
    <main>
        <section class="reservation">
            <h1><?php echo $resultat['titre'] ?></h1>
            <p>Catégorie : <?php $req = "SELECT * FROM categories WHERE id_categorie = :id";
                            $stmt = Database::connect_db()->prepare($req);
                            $stmt->execute(array(
                                ":id" => $resultat['fk_id_categorie']
                            ));
                            foreach ($stmt as $categorie) {
                                echo $categorie['nom'];
                            } ?></p>
            <p class="horaires"><?php echo $datetimeStartDay . ' de ' . $datetimeStartHour . 'h à ' . $datetimeEndHour . 'h'; ?></p>
            <p>Tache : <?php echo $resultat['description'] ?></p>
        </section>

    </main>
    <?php require('footer_spe.php'); ?>
</body>

</html>