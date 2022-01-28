<?php
// require_once(__DIR__ . '/../controller/ReservationClass.php');
// require_once(__DIR__ . '/../controller/User.php');
if (isset($_POST['deconnexion'])) {
    $_SESSION['objet_utilisateur']->deconnexion();
}
?>

<header>
    <nav>
        <div class="logo">
            <a href="./index.php"><img src="https://img.icons8.com/external-parzival-1997-detailed-outline-parzival-1997/64/ffffff/external-schedule-organization-management-parzival-1997-detailed-outline-parzival-1997.png" alt="logo" width="60px" data-aos="zoom-in" data-aos-duration="1500"></a>
        </div>
        <div class="menu">
            <ul class='ul-menu-1'>
                <li data-aos="zoom-in" data-aos-duration="1600"> <a href="./index.php">Home</a> </li>
                <li data-aos="zoom-in" data-aos-duration="1700"> <a href="./view/planning.php">Planning</a> </li>
                <?php if (isset($_SESSION['user'])) { ?>
                <li data-aos="zoom-in" data-aos-duration="1800"> <a href="./view/reservation-form.php">Reservations</a> </li>;
                <li data-aos="zoom-in" data-aos-duration="1900"> <a href="./view/profil.php">Profil</a> </li>
            </ul>
            <ul class="ul-menu-spe">
                <?php if (isset($_SESSION['user']['id_droits'])) { ?>
                <li data-aos="zoom-in" data-aos-duration="2000"> <a href="./view/admin.php">Admin</a> </li>
                <?php } ?>
                <li data-aos="zoom-in" data-aos-duration="2100"> <a href="./view/deconnexion.php">Deconnexion</a> </li>
                <?php  } ?>
            </ul>
            <?php
            if (!isset($_SESSION['user'])) { ?>
                <ul class="ul-menu-2">
                    <li data-aos="zoom-in" data-aos-duration="2200"> <a href="./view/connexion.php">Connexion</a> </li>
                    <li data-aos="zoom-in" data-aos-duration="2300"> <a href="./view/inscription.php">Inscription</a> </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
</header>