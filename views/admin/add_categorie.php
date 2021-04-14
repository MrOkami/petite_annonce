<?php
if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){

    ?>
    <h1 class="alert alert-success text-center text-warning mt-3">Ajouter une catégorie</h1>

    <div id="admin-dashboard">
        <form method="post" enctype="multipart/form-data">
            <h2>Ajouter une catégorie</h2>

            <div class="form-group">
                <label for="type_categorie">Type de catégorie :</label>
                <input type="text" name="type_categorie" class="form-control" placeholder="Type de catégorie" id="type_categorie" required>
            </div>

            <div class="form-group">
                <button name="btn_ajouter_categorie" class="btn btn-info">Ajouter la catégorie</button>
            </div>
        </form>

    </div>
    <?php


}else{
    header("location: accueil?page=1");
}

?>

