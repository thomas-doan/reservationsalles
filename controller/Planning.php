<?php

namespace Controller;

use DateTime;
use Model\Planning_model;

class Planning
{

    public function __construct()
    {

        $this->Planning_model = new Planning_model();
    }


    public function planning()
    {
        $resultat = $this->Planning_model->sql_planning();
        return $resultat;
    }

    public function current_page(){
        if(isset($_GET['week']) && !empty($_GET['week'])){
            $currentPage = (int) strip_tags($_GET['week']);
            if(isset($_POST['moins'])){
                $currentPage--;
                if($currentPage == 0){
                    $currentPage = 1;
                    header('Location: planning.php?week='.$currentPage);
                    exit();
                }
                else{
                    header('Location: planning.php?week='.$currentPage);
                    exit();
                }
            }
            if(isset($_POST['plus'])){
                $currentPage++;
                header('Location: planning.php?week='.$currentPage);
                if($currentPage > 52){
                    $currentPage = 52;
                    header('Location: planning.php?week='.$currentPage);
                    exit();
                }
                else{
                    header('Location: planning.php?week='.$currentPage);
                    exit();
                }
            }
        }
        else{
            $currentPage = date('W');
            header('Location: planning.php?week='.$currentPage);
            exit();
        }
        return $currentPage;
    }

    public function verification_semaine(){

        $currentPage = $this->current_page();
        $week_start = new DateTime();
        $week_start->setISODate(2022,$currentPage);
        echo $week_start->format('d/m/Y');
    }

    public function afficher_planning(){
        $currentPage = $this->current_page();
        $resultat = $this->planning();
        $heure = 8;
        $heure2 = $heure+1;
        while ($heure < 19) {
            $jour = 1;
            echo '<tr>';
            while ($jour < 6) {
                $userLogin = $heure;
                foreach ($resultat as $Date) {
                    $value =  new DateTime($Date['debut']);
                    if (date_format($value, 'G') == $heure && date_format($value, 'N') == $jour && date_format($value, 'W') == $currentPage) {
                        $userLogin = $Date['login'];
                        $reservationTitre = $Date['titre'];
                        $reservationId = $Date['id'];
                        $idCategorie = $Date['fk_id_categorie'];
                    }
                }
                if ($userLogin != $heure) {
                    echo '<td><a class="reservationTD'.$idCategorie.'" href=./reservation.php?id='.$reservationId.'>' .'Utilisateur : '.$userLogin .'</br>Titre : '. $reservationTitre . '</a></td>';
                } else {
                    echo '<td><a href=./reservation-form.php>' . $heure .'-'. $heure2 . 'h</a></td>';
                }
                $jour++;
            }
            echo '</tr>';
            $heure++;
            $heure2++;
        }
    }
}
