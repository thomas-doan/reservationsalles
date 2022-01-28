<?php
namespace Model;

use PDO;
use Database\Database;

class Reservation_model
{

    public function sql_create($title, $desc, $datetime, $datetimeEnd, $id, $categorie)
    {
        $req = "INSERT INTO reservations (titre, description, debut, fin, fk_id_utilisateur, fk_id_categorie) VALUES (:titre, :description, :debut, :fin, :fk_id_utilisateur, :fk_id_categorie)";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":titre" => $title,
            ":description" => $desc,
            ":debut" => $datetime,
            ":fin" => $datetimeEnd,
            ":fk_id_utilisateur" => $id,
            ":fk_id_categorie" => $categorie
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function sql_delete($id)
    {
        $req = "DELETE FROM reservations WHERE id = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function sql_check_delete($id)
    {
        //requete sql
        $req = "SELECT * FROM reservations WHERE id = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }


    public function sql_check_horaire($datetime)
    {
        //requete sql
        $req = "SELECT * FROM reservations WHERE debut = :debut";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":debut" => $datetime
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function sql_display_all_reserv_admin()
    {
        $req = "SELECT * FROM reservations";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function sql_display_reservation($id){
        $req = "SELECT * FROM reservations WHERE id = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
