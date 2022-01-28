<?php
namespace Model;

use Database\Database;

class Planning_model
{
    public function sql_planning()
    {
        $req = "SELECT reservations.id, reservations.titre, reservations.description, reservations.debut, reservations.fin, reservations.fk_id_utilisateur, reservations.fk_id_categorie, utilisateurs.id_utilisateur, utilisateurs.login FROM reservations INNER JOIN utilisateurs ON utilisateurs.id_utilisateur = reservations.fk_id_utilisateur";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetchAll();
        return $resultat;
    }
}
