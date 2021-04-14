

<h1 class="inscrip text-center"><b>INSCRIPTION</b></h1>

<form method="post">
    <div class="form-group">
        <label for="nom_utilisateur">Votre nom</label>
        <input type="text" name="nom_utilisateur" placeholder="Votre nom" id="nom_utilisateur" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email_utilisateur">Votre email</label>
        <input type="email" name="email_utilisateur" placeholder="Votre email" id="email_utilisateur" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password_utilisateur">Votre mot de passe</label>
        <input type="password" name="password_utilisateur" placeholder="Votre mot de passe" id="password_utilisateur" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="repeat_password">Confirmer le mot de passe</label>
        <input name="password_repeter" type="password" placeholder="Confirmer mot de passe" id="repeat_password" class="form-control" required>
    </div>

    <div class="form-group">
        <button name="btnValideInscription" type="submit" class="btn btn-outline-info">S'incrire</button>
    </div>
</form>
