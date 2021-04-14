<?php
require_once "DatabaseModel.php";
class UsersModel extends DatabaseModel
{
    private $id_utilisateur;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $password_utilisateur;


    //Lister tous les utilisateur
    public function users(){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM utilisateurs";
        $users = $db->query($sql);
        return $users;
    }

    public function userParId($id){
        $db = $this->getPDO();
        $sql = "SELECT *  FROM utilisateurs WHERE id_utilisateur = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute(array($id));
        $user_id = $stmt->fetch();
        return $user_id;
    }


    public function connecterUser(){
        //Connexion a PDO
        $db = $this->getPDO();
        $this->email_utilisateur = $_POST['email_utilisateur'];
        $this->password_utilisateur = $_POST['password_utilisateur'];

        //Requète SQL
        $sql = "SELECT * FROM utilisateurs WHERE email_utilisateur = ? AND password_utilisateur = ?";

        //Requète préparée
        $stmt = $db->prepare($sql);
        //Liés les params du formulaire a la table
        $stmt->bindParam(1, $this->email_utilisateur);
        $stmt->bindParam(2, $this->password_utilisateur);

        //Execute la requète
        $stmt->execute();

        //Compter les elements dans table et verifié qu'il y a au - une valeur
        if($stmt->rowCount() >= 1){
            $row =  $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_utilisateur = $row['id_utilisateur'];
            $this->email_utilisateur = $row['email_utilisateur'];
            $this->password_utilisateur = $row['password_utilisateur'];

            if($this->email_utilisateur == $row['email_utilisateur'] && $this->password_utilisateur == $row['password_utilisateur']){
                //Demarre la session
                session_start();
                $_SESSION['connecter_utilisateur'] = true;
                $_SESSION['id_utilisateur'] = $this->id_utilisateur;
                $_SESSION['email_utilisateur'] = $this->email_utilisateur;
                header("Location: http://localhost/Petite_annonce/gestion_annonces");
            }else{
                echo "<p class='alert alert-danger'>Erreur ! Merci de vérifié votre email et mot de passe</p>";
            }

        }else{
            echo "<p class='alert alert-danger'>Aucun utilisateur ne possèdent cet email et mot de passe</p>";
        }





    }
}