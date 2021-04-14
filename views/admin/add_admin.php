<?php
if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){

    ?>
    <h1 class="alert alert-success text-center text-warning mt-3">AJOUTER UN ADMINISTRATEUR</h1>

    <div id="admin-dashboard">
        <form method="post" enctype="multipart/form-data">
            <h2>Ajouter un administrateur</h2>

            <div class="form-group">
                <label for="email_admin">Email admin :</label>
                <input type="email" name="email_admin" class="form-control" placeholder="Email de l'admin" id="email_admin" required>
            </div>

            <div class="form-group">
                <label for="password_admin">Mot de passe admin :</label>
                <input type="password" name="password_admin" class="form-control" placeholder="Mot de passe admin" id="password_admin" required>
            </div>

            <div class="form-group">
                <button name="btn_ajouter_admin" class="btn btn-info">Ajouter Administrateur</button>
            </div>
        </form>

    </div>
    <?php


}else{
    header("location: accueil?page=1");
}

?>
