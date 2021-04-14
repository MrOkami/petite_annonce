<h1 class="UserConnec"><b>CONNEXION</b></h1>

<form method="post">


    <div class="form-group">
        <label for="email_utilisateur">Votre email</label>
        <input type="email" name="email_utilisateur" placeholder="Votre email" id="email_utilisateur" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password_utilisateur">Votre mot de passe</label>
        <input type="password" name="password_utilisateur" placeholder="Votre mot de passe" id="password_utilisateur" class="form-control" required>
    </div>


    <div class="form-group">
        <button name="btn-connexion" type="submit" class="btn btn-outline-info">Connexion</button>
    </div>
</form>

<?php
if(isset($_POST['btn-connexion'])){
    connexionUser();
}
?>


