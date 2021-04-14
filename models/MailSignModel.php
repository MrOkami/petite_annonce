<?php
require_once "DatabaseModel.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


class MailSignModel extends DatabaseModel
{
    //Reprise des propriétés de phpMyAdmin
    private $id_utilisateur;
    private $nom_utilisateur;
    private $email_utilisateur;
    private $password_utilisateur;

    public function validerSignUsersEmail(){
        //Insatnce de la classe PHPMailer
        $mail = new PHPMailer();
        //Trigger des erreurs
        try{
            //Config pour mailtrap
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Autorise le debug
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '8a3e0252469823'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> zendFramework https://mailtrap.io/inboxes/1163067/messages
            $mail->Password = 'cf7dceddc82ca0'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
            $mail->CharSet = 'UTF-8';

            //Envoyeur et destinataire
            $mail->setFrom('annonce@gmail.com', 'Annonces Administration');
            $mail->addAddress('annonce@gmail.com', 'Administrateur petite_annonces.com');
            $mail->addReplyTo('annonce@gmail.com', 'Annonces Administration');
            //Format HTML
            $mail->isHTML(true);
            //Connexion a PDO
            $db = $this->getPDO();
            //Recupération des utilisateurs
            $recupUtilisateurs = $db->query("SELECT * FROM utilisateurs");
            //Utilisation des propriétées privées
            $this->email_utilisateur = $_POST['email_utilisateur'];
            $this->nom_utilisateur = $_POST['nom_utilisateur'];
            $this->password_utilisateur = $_POST['password_utilisateur'];
            $mail->Subject = "Validation de votre inscription sur le site petite_annonces.com";

            //Insertion des utilisateurs dans la table
            $ajouterUtlisateur = $db->prepare("INSERT INTO `utilisateurs`(`nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES (?,?,?)");
            //Liaison des paramètres
            $ajouterUtlisateur->bindParam(1, $this->nom_utilisateur);
            $ajouterUtlisateur->bindParam(2, $this->email_utilisateur);
            $ajouterUtlisateur->bindParam(3, $this->password_utilisateur);
            //Execution de la requète
            $ajouterUtlisateur->execute(array($this->nom_utilisateur, $this->email_utilisateur, $this->password_utilisateur));


            //Si ca marche on appel la redirection
            //Passer les valeur email + password dans url avec get
            //$redirect = "http://localhost/petite_annonce/connexion_users&email=".$this->email_utilisateur."&password=".$this->password_utilisateur;
            $redirect = "http://localhost/petite_annonce/connexion_users";
            //Corp de la page HTML5
            $mail->Body = '
                     <!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="Content-Type" content="text/html">
                            <title>Votre inscription sur Annonce.com</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body style="color: #43617f; font-size: 22px;">
                        <div style="padding: 20px;">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6fV5-gvJoErCmW1i-kzcc5C0slzboniFycw&usqp=CAU" width="75px" height="75px">
                        </div>
                        <div style="padding: 20px;">
                            <h1>Annonce.com</h1>
                            <h2>Bonjour : '.$this->email_utilisateur.'</h2>
                            <p>Vous êtes desormais inscrit sur le site Annonce.com merci de valider votre inscription avec le liens suivant</p><br />
                            <p>Recapitulatif de vos information de connexion</p>
                            <p>Nom :<b style="color: #8b0000">'.$this->nom_utilisateur.'</b></p>
                            <p>Email :<b style="color: #8b0000"> '.$this->email_utilisateur.'</b></p>
                            <p>Mot de passe :<b style="color: #8b0000;">'.$this->password_utilisateur.'</p>
                            <br /><br />
                            <a href="' . $redirect . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer votre inscription sur notre site</a><br />
                            <br /><br />                      
                            <p style="color: #43617f;">Merci d\'utiliser notre site web</p>
                            <p style="color: #43617f;">Cordialement : Petite_annonces.com: Votre Administrateur</p>    
                        </div>
                        </body>
                        </html>
                        ';
            //Conversion de HTML5
            $mail->body = "MIME-Version: 1.0" . "\r\n";
            $mail->body .= "Content-type:text/html;charset=utf8" . "\r\n";


            //Envoi de email
            $mail->send();
        }catch(Exception $exception){
            die();
            //echo "<p class='alert alert-danger'>Une erreur est survenue lors de votre inscription, merci de vérifié les champs !</p>";
        }
    }

}