<?php
require '../vendor/autoload.php';
use Controller\Securite;

session_start();

if (!Securite::estConnecte()) {
    header('Location:../index.php');
    exit();
} else {
    $_SESSION['objet_utilisateur']->deconnexion();
    header('Location:../index.php');
    exit();
}
?>
