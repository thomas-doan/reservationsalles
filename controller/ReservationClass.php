<?php

namespace Controller;

use Controller\Toolbox;
use Model\Reservation_model;

class ReservationClass
{
    public $id_user;

    public function __construct($id_user)
    {
        $this->id_user = $id_user;
        $this->Reservation_model = new Reservation_model();
    }

    public function create($title, $desc, $datetime, $datetimeEnd, $categorie)
    {

        if ($this->Reservation_model->sql_check_horaire($datetime) == false) {
            $this->Reservation_model->sql_create($title, $desc, $datetime, $datetimeEnd, $this->id_user, $categorie);
            Toolbox::ajouterMessageAlerte("Votre horaire est reservée !", Toolbox::COULEUR_VERTE);
            header('Location: ./planning.php');
            exit();
        } else {
            Toolbox::ajouterMessageAlerte("Cette horaire est deja reservée !", Toolbox::COULEUR_ROUGE);
            header('Location: ./reservation-form.php');
            exit();
        }
    }

    public function delete($id_reservation)
    {

        if ($this->Reservation_model->sql_check_delete($id_reservation) == true) {
            $this->Reservation_model->sql_delete($id_reservation);
            Toolbox::ajouterMessageAlerte("Horraire supprimé !", Toolbox::COULEUR_VERTE);
            header('Location: ../view/admin.php');
            exit();
        } else {
            Toolbox::ajouterMessageAlerte("Cette reservation n'existe pas !", Toolbox::COULEUR_ROUGE);
            header('Location: ../view/admin.php');
            exit();
        }
    }

    public function display_all_reserv_admin()
    {
        $resultat = $this->Reservation_model->sql_display_all_reserv_admin();
        return $resultat;
    }

    public function display_reservation($id)
    {
        $resultat = $this->Reservation_model->sql_display_reservation($id);
        return $resultat;
    }
}
