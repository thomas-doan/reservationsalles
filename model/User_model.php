<?php
namespace Model;

use PDO;
use Database\Database;

class User_model
{

    public function sql_modifier_profil($login_secure, $prenom_secure, $nom_secure, $email_secure, $id)
    {
        $req = "UPDATE utilisateurs set login = :login, prenom = :prenom, nom = :nom, email = :email WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure,
            ":prenom" => $prenom_secure,
            ":nom" => $nom_secure,
            ":email" => $email_secure,
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function sql_modifier_profil_sans_email($login_secure, $prenom_secure, $nom_secure, $id)
    {
        $req = "UPDATE utilisateurs set login = :login, prenom = :prenom, nom = :nom WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure,
            ":prenom" => $prenom_secure,
            ":nom" => $nom_secure,
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function sql_info_user_id($id)
    {
        //requete sql
        $req = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function sql_info_all_user()
    {
        //requete sql
        $req = "SELECT * FROM utilisateurs";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }


    public function sql_delete_user_as_admin($id_user)
    {

        $req = "DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id_utilisateur" => $id_user
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function sql_modifier_profil_password($password, $id)
    {

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $req = "UPDATE utilisateurs set password = :password  WHERE id_utilisateur = :id";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":password" => $password_hash,
            ":id" => $id
        ));
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
