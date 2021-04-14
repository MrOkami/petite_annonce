<?php
session_start();
require "../vendor/autoload.php";

//Controller
require_once "../controller/AdminController.php";
require_once "../controller/AnnoncesController.php";
require_once "../controller/CategoriesController.php";
require_once "../controller/RegionsController.php";
require_once "../controller/UsersController.php";

//Verif de $_GET[""] dans l'URL
//index.php?url=accueil (toutes vos routes)

//Creation de la clé URL = URL
if (isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}

//Clé URL = PAGE
if (isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = "";
}

//Si clé NULL on redirigee vers l'accueil pour la pagination des annonces
if ($url === ""){
    $url = "accueil?page=1";
    $page = "";
}

/******************************************************
*********************  ROOTING ************************
******************************************************/

/***************** ACCUEIL **************************/
if ($url == "accueil") {
    $title = "Acceuil";
    showAnnonces();

}elseif ($url == 'users'){
    showUser();


}elseif ($url === "rechercher"){
    $title = "Recherche";
    searchGlobaleMotCle();
    getAnnonceByCandR();
}


/************** inscription USERS *********************/
elseif ($url == "inscription_users"){
    $title = "Inscription";

    //appel du form d'inscription users
    require_once "users/inscription_users.php";
    //par defaut l'inscription retourne false
    $form = false;

    //verif de l'existance des champs du form

    if (isset($_POST['nom_utilisateur']) && isset($_POST['password_utilisateur'])){
        //les 2 mots de passe doivent etre identique
        if ($_POST['password_utilisateur'] === $_POST['password_repeter']){
            $form = true;
            if ($form){
                envoiEmailInscription();
                echo "<p class='alert alert-success'>Merci de votre inscription. Merci de valider le mail, afin d'acceder à votre tableau de bord</p>";
            }else{
                echo "<p class='alert alert-warning'>Merci de remplir tous les champs.</p>";
            }
        }else{
            echo "<p class='alert alert-warning'>Les mots de passes ne sont pas identique</p>";
        }
    }

    /***************** Connec USERS ***************************************/
}elseif ($url === "connexion_users"){
    $title = "Connexion";
    require_once "../views/users/connexion_users.php";

    //Acces CRUD users si connecter
    //verif de la connec users
}elseif ($url === "gestion_annonces" && isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){
    $title = "Gestion des annonces";

    //tableau de bord utilisateur
    showAnnonceParUser();
    //redirige a la connexion si pas co

}elseif ($url === 'details_annonce' && isset($_GET['id_details']) && $_GET['id_details'] > 0){
    $title = "détails des annonces";
    showDetails();

/**************** Add Annonces pour les users co ******************************/
}elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === 'add_annonce'){
    $title = "Ajouter une annonce";
    require_once "../views/annonces/add_annonce.php";
    $addForm = false;

    if(isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot'])  && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])){
        $addForm = true;
        if($addForm) {
            addAnnonceParUser($_POST['nom_annonce'], $_POST['description_annonce'], $_POST['prix_annonce'], $_POST['photo_annonce'], $_POST['date_depot'], $_POST['categorie_id'], $_SESSION['id_utilisateur'], $_POST['regions_id']);
            }else{
            echo "le fomulaire n'est pas rempli correctement";
        }

    }else{
        echo "<p class='alert alert-danger'>Merci de vérifié tous les champs du formulaire !</p>";
    }


/************************** DELETE Annonce ***********************************************/
}elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION["connecter_utilisateur"] === true && $url === 'delete_annonce' && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    $title = "Suppimer une annonce";
    deleteAnnonceParUsers();

/******************* Editer une annonce ******************************/
}elseif (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true && $url === 'editer_annonce' && isset($_GET["id_edit"]) && $_GET['id_edit'] > 0){
    $title = "Editer une annonce";
    require_once "../views/annonces/editer_annonce.php";

    if (isset($_POST['nom_annonce']) && isset($_POST['description_annonce']) && isset($_POST['prix_annonce']) && isset($_POST['photo_annonce']) && isset($_POST['date_depot']) && isset($_POST['categorie_id']) && $_SESSION['id_utilisateur'] && isset($_POST['regions_id'])){
        editerAnnonceParUser($_POST['nom_annonce'], $_POST['description_annonce'], $_POST['prix_annonce'], $_POST['photo_annonce'], $_POST['date_depot'], $_POST['categorie_id'], $_SESSION['id_utilisateur'], $_POST['regions_id'], $_GET['id_edit']);
    }


/*******************************
****** Connexion ADMIN *********
*******************************/
}elseif ($url == 'hBpoN5so'){
    $title = "Connexion Administrateur";
    require_once "../views/admin/connexion_admin.php";

    /***************** espace Admin *********************/
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url == 'espace_admin'){
    $title = "Espace d'administrattion";
    showAllTables();

    /**************** Supprimer un Admin *****************/
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url=== 'delete_admin' && isset($_GET['id_suppr']) && $_GET["id_suppr"] > 0){
    $title = "Supprimer un Admin";
    deleteAdmin();

    /***************** Ajout d'un Admin ********************/
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url === 'add_admin'){
    $title = "Ajout d'un administrateur";
    require_once "../views/admin/add_admin.php";
    if (isset($_POST['email_admin']) && isset($_POST['password_admin'])){
        addAdmin($_POST['email_admin'], $_POST['password_admin']);
    }

    /************* ajout de categorie **************************/
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true && $url = 'add_categorie'){
    $title = " Ajouter une catégorie";
    require_once "../views/admin/add_categorie.php";
    if (isset($_POST["type_categorie"])){
        addCatAdmin($_POST["type_categorie"]);
    }

/********************** suppression annonce/ustilisateur/categorie ********************/

}elseif (isset($_SESSION['connecter_admin']) && $_SESSION["connecter_admin"] === true && $url === 'delete_annonce_admin' && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    deleteAnnonceAdmin();
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION["connecter_admin"] === true && $url === 'delete_admin_users' && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    deleteAdminUser();
}elseif (isset($_SESSION['connecter_admin']) && $_SESSION["connecter_admin"] === true && $url === 'delete_categorie_admin' && isset($_GET['id_suppr']) && $_GET['id_suppr'] > 0){
    deleteAdminCategorie();


/*************** Deconnexion *****************/

}elseif ($url === 'deconnexion'){
    require_once "../views/deconnexion.php";

/************** Contact Vendeur **************/
}elseif ($url == 'email_vendeur'){
    $title = "Contact Vendeur";
    showUserParId($_GET['id']);

/************* Annonce ******************/
}elseif ($url === 'region'){
    $title = "Annonce par Region";
    $id = $_GET['id'];
    annonceParRegion($_GET['id']);
}


$content = ob_get_clean();
require_once "template.php";









