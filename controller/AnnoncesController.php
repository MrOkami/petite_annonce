<?php
require_once "../models/AnnoncesModel.php";

/*
 * POur les Visiteurs
 */
function showAnnonces(){

    //Instance de la classe Annonce
    $annonce = new AnnoncesModel();
    //stock dansune variable l'appel de la methode conernée
    $recupAnnonce = $annonce->showAllAnnonces();
    require_once "../views/accueil.php";

}

function showAnnoncesJson(){
    $annonce = new AnnoncesModel();
    $recupAnnonce = $annonce->annonceJson();
    require_once "../views/accueil.php";
}

/*
 * Pour les Users
 */
//Afficher le annonces par utilisateur
function showAnnonceParUser(){
    //Insatnce du de la classe Annonce
    $annonce = new AnnoncesModel();
    $nbrPages = $annonce->showAnnonceParUser();
    require_once "../views/users/gestion_users.php";
}

//Affiche les details d'une annone d'un utilisateur
function showDetails(){
    //Instance de la classe Annonce
    $annonce = new AnnoncesModel();
    $details = $annonce->showDetailsAnnonce();
    require_once "../views/annonces/details_annonce.php";
}

//Ajouter une annonce pour 1 utlisateur
function addAnnonceParUser($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id){
    $annonce = new AnnoncesModel();
    $ajouterAnnonce = $annonce->addAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id);
    if($ajouterAnnonce){
        header("Location: gestion_annonces");
    }else{
        echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
    }
}

//Supprimer l'annonce d'un utilisateur
function deleteAnnonceParUsers(){

    $annonce = new AnnoncesModel();
    $delete = $annonce->deleteAnnonce();
    if($delete){
        header("Location: gestion_annonces");
    }else{
        echo "rien à supprimer";
    }

}

//Editer une annonce pour un utilisateur
function editerAnnonceParUser($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id){

    $annonce = new AnnoncesModel();
    $_GET['id'] = $id;
    $update = $annonce->editerAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $_GET['id_edit']);
    if($update){
        header("Location: gestion_annonces");
    }else{
        echo "<p class='alert alert-danger'>Une erreur est survenue durant l'ajout de votre annonce merci de réessayé !</p>";
    }
}

function searchGlobaleMotCle(){
    $annonce = new AnnoncesModel();
    $results = $annonce->searchAnnonceMotCle();
    if($results){
        require "../views/annonces/result_search_globale.php";
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
    }

}

function getAnnonceByCandR(){
    $annonce = new AnnoncesModel();
    $resultsC_R = $annonce->getAnnonceByRandC();
    if($resultsC_R){
        require_once "../views/annonces/resultat_search_C_R.php";
    }else{
        echo "<p class='alert-warning text-center p-2 mt-2'><b>Pas d'annonce pour cette region et cette catégorie</b></p>";
    }
}






