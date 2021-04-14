<?php
require_once "../models/AdminModel.php";
require_once "../models/UsersModel.php";

//Connexion de l'administrateur
function connecterAdmin(){
    $administrateur = new AdminModel();
    $connecteAdmin = $administrateur->connexionAdmin();
    return $connecteAdmin;
}

//Afficher la table des admin + les annonces + les utilisateurs + regions + catégories
function showAllTables(){
    $admin = new AdminModel();
    $tableAdmin = $admin->showTableAdmin();
    $tableAnnonce = $admin->showTableAnnonce();
    $tableRegion = $admin->showRegion();
    $tableCategorie = $admin->showCategories();
    $tableUtilisateurs = $admin->showTousUtilisateur();
    require_once '../views/admin/espace_admin.php';
}

//Supprimer un admin
function deleteAdmin(){
    //Instance du model (classe) annonce
    $admin = new AdminModel();
    $delete = $admin->deleteAdmin();
    if($delete){
        header("Location: espace_admin");
    }else{
        echo "rien a supprimer";
    }
}

//Ajouter un admin
function addAdmin($email_admin, $password_admin){
    $admin = new AdminModel();
    $ajouterAdmin = $admin->addAdmin($email_admin, $password_admin);
    if($ajouterAdmin){
        header("location: espace_admin");
    }else{
        echo "Erreur";
    }
}

//Supprimer une annonce d'un utilisateur
//Supprimer un admin
function deleteAnnonceAdmin(){
    //Instance du model (classe) annonce
    $admin = new AdminModel();
    $delete = $admin->deleteAnnonceUser();
    if($delete){
        header("Location: espace_admin");
    }else{
        echo "rien a supprimer";
    }
}


//Lister les utilisateur
function listerUtilisateur(){
    $utilisateur = new UsersModel();
    $afficher_utilisateur = $utilisateur->utilisateurs();
    ?>
    <option class="text-success" value="">Choix de l'utilisateur :</option>
    <?php
    foreach ($afficher_utilisateur as $user){
        ?>
        <option value="<?= $user['id_utilisateur'] ?>"><?= $user['email_utilisateur'] ?></option>
        <?php

    }
    return $afficher_utilisateur;
}

//Suprimmer un utilisateur
function deleteAdminUser(){
    $admin = new AdminModel();
    $suprUtilisateur = $admin->deleteUserAdmin();
    if($suprUtilisateur){
        header("Location: espace_admin");
    }else{
        echo "rien a supprimer";
    }
}

//Suprimmer une catégorie
function deleteAdminCategorie(){
    $admin = new AdminModel();
    $suprCategorie = $admin->deleteCategorie();
    if($suprCategorie){
        header("Location: espace_admin");
    }else{
        echo "rien a supprimer";
    }
}

function addCatAdmin($type_categorie){
    $admin = new AdminModel();
    $addCatAdmin = $admin->addCategorieAdmin($type_categorie);
    if($addCatAdmin){
        header("location: espace_admin");
    }else{
        echo "Erreur";
    }
}