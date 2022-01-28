<?php
namespace Model;

use PDO;
use Database\Database;
use Controller\Toolbox;
use Controller\Securite;

class Register
{

    public static function connexion($email, $password)
    {   //secure les post d'injection sql ou script
        $email_secure = Securite::secureHTML($email);
        $password_secure = Securite::secureHTML($password);

        //verification email déjà existent
        if (Register::info_user_email($email_secure) == true) {
            //requete SQL
            $resultat = Register::info_user_email($email_secure);
            if (password_verify($password_secure, $resultat['password'])) {

                $_SESSION['user']['id'] = $resultat['id_utilisateur'];
                $_SESSION['user']['login'] = $resultat['login'];
                $_SESSION['user']['id_droits'] = $resultat['id_droits'];



                Toolbox::ajouterMessageAlerte("Connexion faite.", Toolbox::COULEUR_VERTE);
                header("Location: ../index.php");
                exit();
            } else {
                Toolbox::ajouterMessageAlerte("Mdp incorrect.", Toolbox::COULEUR_ROUGE);
                header("Location: ./connexion.php");
                exit();
            }
        } elseif (Register::info_user_email($email_secure) == false) {
            Toolbox::ajouterMessageAlerte("Email incorrect.", Toolbox::COULEUR_ROUGE);
            header("Location: ./connexion.php");
            exit();
        }
    }

    public static function register_utilisateur($login, $prenom, $nom, $email, $password)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);
        $prenom_secure = Securite::secureHTML($prenom);
        $nom_secure = Securite::secureHTML($nom);
        $email_secure = Securite::secureHTML($email);
        $password_secure = Securite::secureHTML($password);

        if (filter_var($email_secure, FILTER_VALIDATE_EMAIL)) {
            if (Register::info_user($login_secure) == false) {
                //Hash password
                $password_hash = password_hash($password_secure, PASSWORD_BCRYPT);

                $req = "INSERT INTO utilisateurs (login, prenom, nom, email, password) VALUES (:login, :prenom, :nom, :email, :password )";
                $stmt = Database::connect_db()->prepare($req);
                $stmt->execute(array(
                    ":login" => $login_secure,
                    ":prenom" => $prenom_secure,
                    ":nom" => $nom_secure,
                    ":email" => $email_secure,
                    ":password" => $password_hash
                ));
                Toolbox::ajouterMessageAlerte("Le compte est créé!", Toolbox::COULEUR_VERTE);
                header("Location: ../index.php");
                exit();
            }
            if (Register::info_user($login_secure) == true) {
                Toolbox::ajouterMessageAlerte("Login est déjà utilisé !", Toolbox::COULEUR_ROUGE);
                header("Location: ./inscription.php");
                exit();
            }
        } else {
            Toolbox::ajouterMessageAlerte("L'email n'est pas valide !", Toolbox::COULEUR_ROUGE);
            header("Location: ./inscription.php");
            exit();
        }
    }

    public static function info_user($login)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);

        //requete sql
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public static function info_user_email($email)
    {

        //requete sql
        $req = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":email" => $email
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}
