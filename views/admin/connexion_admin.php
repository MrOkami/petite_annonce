<h1 class="text-center text-primary"><b>CONNEXION ADMINISTRATION</h1>

<div style="background: #965b15; padding: 20px">

    <form method="post">

        <div class="form-group">
            <label for="email_admin">Votre email</label>
            <input type="email" name="email_admin" placeholder="Votre email" id="email_admin" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_admin">Votre mot de passe</label>
            <input type="password" name="password_admin" placeholder="Votre mot de passe" id="password_admin" class="form-control" required>
        </div>


        <div class="form-group">
            <button name="btn-connexion-admin" type="submit" class="btn btn-outline-info">Connexion a l'espace d'administration</button>
        </div>
    </form>

</div>
<?php
if(isset($_POST['btn-connexion-admin'])){
    //echo "<script>alert('ok c bon le click')</script>";
    connecterAdmin();
}
?>
