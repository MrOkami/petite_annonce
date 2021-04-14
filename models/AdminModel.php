<?php
require_once "DatabaseModel.php";

class AdminModel extends DatabaseModel
{
    //admin
    private $id_admin;
    private $email_admin;
    private $password_admin;

    //User
    private $id_utilisateur;

    //catégorie
    private $id_categorie;
    private $type_categorie;

    //connec de l'admin
    public function connexionAdmin(){
        //PDO
        $db = $this->getPDO();

        $this->email_admin = $_POST['email_admin'];
        $this->password_admin = $_POST['password_admin'];

        $sql = "SELECT * FROM administration WHERE email_admin = ? AND password_admin = ?";

        $admin = $db->prepare($sql);

        $admin->bindParam(1, $_POST['email_admin']);
        $admin->bindParam(2, $_POST['password_admin']);

        if ($admin->rowCount() >= 0){
            $row = $admin->fetch(PDO::FETCH_BOTH);
            $this->id_admin= $row['id_admin'];
            $this->email_admin = $row['email_admin'];
            $this->password_admin = $row['password_admin'];

            if ($this->email_admin == $row[$this->email_admin] && $this->password_admin == $row[$this->password_admin]){
                session_start();
                $_SESSION['connecter_admin'] = true;
                $_SESSION['email_admin'] = $_POST['email_admin'];
                header('Location : espace_admin');
            }else{
                echo "<p class='alert alert-danger'>L'email et le mot passe ne sont pas valide !</p>";
            }
        }else{
            echo "<p class='alert alert-danger'>Aucun administrateur ne possède cet email et ce mot de passe !</p>";
        }
    }

    //Afficher toute les valeurs de la table admin
    public function showTableAdmin(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM administration";
        $datas = $db->query($sql);
        return $datas;
    }

    //ajouter un admin
    public function addAdmin($email_admin, $password_admin){
        $db = $this->getPDO();
        $sql = "INSERT INTO administration (email_admin, password_admin) VALUE (?,?)";

        $this->email_admin = $email_admin;
        $this->password_admin = $password_admin;

        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $email_admin);
        $stmt->bindParam(2, $password_admin);
        $stmt->execute(array($email_admin,$password_admin));

        return $stmt;
    }

    //Delete admin
    public function deleteAdmin(){

        $db = $this->getPDO();
        $sql = "DELETE FROM administration WHERE id_admin = ?";

        $stmt =$db->prepare($sql);
        $this->id_admin = $_GET['id_suppr'];
        //Liaison des param (id de l'annonce à ID de l'URL($_GET))
        $stmt->bindParam(1, $this->id_admin);

        $deleteAdmin = $stmt->execute();

        return $deleteAdmin;
    }

    /*******************
    ** Table Annonces **
    *******************/

    //Affichage de toutes les annonces
    public function showTableAnnonce(){
        $db = $this->getPDO();
        //Requète SQL + jointure
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions ORDER BY utilisateur_id ASC";
        $request = $db->query($sql);
        return $request;
    }

    //delete  l'annonce d'un user
    public function deleteAnnonceUser(){
        $db = $this->getPDO();
        $sql = "DELETE FROM annonces WHERE id_annonce = ?";

        $stmt = $db->prepare($sql);
        $this->id_annonce = $_GET['id_suppr'];
        $stmt->bindParam(1, $this->id_annonce);

        $delete = $stmt->execute();
        return $delete;
    }


    /**********************
    ******* REGIONS *******
    **********************/
    public function showRegion(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM regions";
        $stmt = $db->query($sql);
        return $stmt;
    }

    public function deleteRegion(){
        $db = $this->getPDO();
        $sql = "DELETE FROM regions WHERE id_regions = ?";

        $stmt = $db->prepare($sql);
        $this->id_regions = $_GET['id_suppr'];
        $stmt->bindParam(1, $id_regions);

        $delete = $stmt->execute();
        return $delete;
    }

    /*************************
    ******** CATEGORIES ******
    *************************/
    public function showCategories(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM categories";
        $stmt = $db->query($sql);
        return $stmt;
    }
    //delete
    public function deleteCategorie(){
        $db = $this->getPDO();
        $sql = "DELETE FROM categories WHERE id_categorie = ?";

        $stmt = $db->prepare($sql);
        $this->id_categorie = $_GET['id_suppr'];
        $stmt->bindParam(1, $id_categorie);

        $delete = $stmt->execute();
        return $delete;
    }
    //Add
    public function addCategorieAdmin($type_categorie){
        $db = $this->getPDO();
        $sql = "INSERT INTO categories (type_categorie) VALUE (?)";
        $this->type_categorie = $type_categorie;

        $stmt = $db->prepare($sql);;
        $stmt->bindParam(1, $type_categorie);

        $stmt = $stmt->execute(array($type_categorie));
        return $stmt;
    }



    /***************************
     ********** USERS **********
     **************************/
    public function showTousUtilisateur(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM utilisateurs";
        $stmt = $db->query($sql);
        return $stmt;
    }

    //Delete user
    public function deleteUserAdmin(){
        $db = $this->getPDO();
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";

        $stmt = $db->prepare($sql);
        $this->id_utilisateur = $_GET['id_suppr'];
        $stmt->bindParam(1, $this->id_utilisateur);

        $delete = $stmt->execute();
        return $delete;
    }





}