<?php

namespace Controller;

use Model\User_model;
use Controller\Toolbox;
use Controller\Securite;
use Model\Register;

class User
{
    public $id;


    public function __construct($id)
    {

        $this->id = $id;

        $this->User_model = new User_model();
    }


    //afficher donnée utilisateur connecté
    public function info_user()
    {
        $resultat = $this->User_model->sql_info_user_id($this->id);

        return $resultat;
    }

    //afficher toutes les données des utilisateurs
    public function info_all_user()
    {
        $resultat = $this->User_model->sql_info_all_user();

        return $resultat;
    }

    //modifier les infos du profil
    public function modifier_profil_user($login, $prenom, $nom, $email)
    {
        $login_secure = Securite::secureHTML($login);
        $prenom_secure = Securite::secureHTML($prenom);
        $nom_secure = Securite::secureHTML($nom);
        $email_secure = Securite::secureHTML($email);


        if (filter_var($email_secure, FILTER_VALIDATE_EMAIL)) {

            //profil initiale user à la connexion//
            $profil_user_initial = $this->info_user();

            //Si les champs sont identiques//
            if (
                $profil_user_initial['login'] == $login_secure && $profil_user_initial['prenom'] == $prenom_secure && $profil_user_initial['nom'] == $nom_secure
                && $profil_user_initial['email'] == $email_secure
            ) {
                Toolbox::ajouterMessageAlerte("Aucune modification !", Toolbox::COULEUR_ROUGE);
                header("Location: ./profil.php");
                exit();
            }

            //Si l'email reste inchangé, modification des infos//
            elseif ($profil_user_initial['email'] == $email_secure) {
                $this->User_model->sql_modifier_profil($login_secure, $prenom_secure, $nom_secure, $email_secure, $this->id);

                //set les nouvelles valeurs en variable de session
                $resultat = $this->User_model->sql_info_user_id($this->id);
                $_SESSION['user']['email'] = $resultat['email'];
                $_SESSION['user']['id'] = $resultat['id_utilisateur'];

                Toolbox::ajouterMessageAlerte("Modification ok !", Toolbox::COULEUR_VERTE);
                header("Location: ./profil.php");
                exit();
            }

            //Si l'email change et n'est pas en bdd, modification des infos//
            elseif (Register::info_user($email_secure) == false) {
                $this->User_model->sql_modifier_profil($login_secure, $prenom_secure, $nom_secure, $email_secure, $this->id);

                //set les nouvelles valeurs en variable de session
                $resultat = $this->User_model->sql_info_user_id($this->id);
                $_SESSION['user']['email'] = $resultat['email'];
                $_SESSION['user']['id'] = $resultat['id_utilisateur'];

                Toolbox::ajouterMessageAlerte("Modification ok !", Toolbox::COULEUR_VERTE);
                header("Location: ./profil.php");
                exit();
            }

            //Si l'email envoyé match en bdd, refuser la modification//
            elseif (Register::info_user($email_secure) == true) {
                $this->User_model->sql_modifier_profil_sans_email($login_secure, $prenom_secure, $nom_secure, $this->id);

                Toolbox::ajouterMessageAlerte("L'email est déjà utilisé !", Toolbox::COULEUR_ROUGE);
                header("Location: ./profil.php");
                exit();
            }
        } else {
            $this->User_model->sql_modifier_profil_sans_email($login_secure, $prenom_secure, $nom_secure, $this->id);
            Toolbox::ajouterMessageAlerte("Email non valide !", Toolbox::COULEUR_ROUGE);
            header("Location: ./profil.php");
            exit();
        }
    }

    public function modifier_profil_password($password_ancien, $password_nouveau)
    {
        $password_ancien_secure = Securite::secureHTML($password_ancien);
        $password_nouveau_secure = Securite::secureHTML($password_nouveau);

        // recup mdp bdd
        $password_bdd = $this->User_model->sql_info_user_id($this->id);
        $password_bdd['password'];

        //verification password 
        if (password_verify($password_ancien_secure, $password_bdd['password'])) {

            $this->User_model->sql_modifier_profil_password($password_nouveau_secure, $this->id);
            Toolbox::ajouterMessageAlerte("Mot de passe modifié !", Toolbox::COULEUR_VERTE);
            header("Location: ./profil.php");
            exit();
        } else {
            Toolbox::ajouterMessageAlerte("Mot de passe erroné !", Toolbox::COULEUR_ROUGE);
            header("Location: ./profil.php");
            exit();
        }
    }


    public function deconnexion()
    {
        unset($_SESSION['user']);
    }



    public function delete_user_as_admin($id_user)
    {

        if ($this->User_model->sql_delete_user_as_admin($id_user)) {
            Toolbox::ajouterMessageAlerte("Utilisateur supprimé !", Toolbox::COULEUR_VERTE);
            header("Location: ./admin.php");
            exit();
        } else {
            Toolbox::ajouterMessageAlerte("Id non valide !", Toolbox::COULEUR_ROUGE);
            header("Location: ./admin.php");
            exit();
        }
    }
}
