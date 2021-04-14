<?php
require_once "../models/MailSignModel.php";
require_once "../models/UsersModel.php";


function envoiEmailInscription(){
    //Instance de la classe email
    $email = new MailSignModel();
    $envoiEmail = $email->validerSignUsersEmail();
    return $envoiEmail;
}

//Connecter un utilisateur

function connexionUser(){
    //Instance du model utilisateur
    $utilisateur = new UsersModel();
    $connecter_user = $utilisateur->connecterUser();
    return $connecter_user;

}


/******************* Lister les utilisateur ************************/
function showUser(){
    $utilisateur = new UsersModel();
    $showUser = $utilisateur->users();
    require_once "../views/users.php";
}

function showUserParId($id){
    $utilisateur = new UsersModel();
    $showUsersParId = $utilisateur->userParId($_GET['id']);
    require_once '../views/users/email_vendeur.php';
    return $showUsersParId;
}