<?php
if(isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){

    ?>
    <h1 class="alert alert-success text-center text-warning mt-3">AJOUTER ANNONCES</h1>

    <div id="user-dashboard">
        <form method="post" enctype="multipart/form-data">
            <h2>Ajouter votre annonces</h2>

            <div class="form-group">
                <label for="nom_annonce">Nom de l'annonce :</label>
                <input type="text" name="nom_annonce" class="form-control" placeholder="Nom de votre annonce" id="nom_annonce" required>
            </div>

            <div class="form-group">
                <label for="description_annonce">Description de l'annonce :</label>
                <textarea name="description_annonce" class="form-control" placeholder="Description de votre annonce" id="description_annonce" required></textarea>
            </div>

            <div class="form-group">
                <label for="prix_annonce">Prix de l'annonce :</label>
                <input type="number" step="any" name="prix_annonce" class="form-control" placeholder="Prix de votre annonce en €" id="prix_annonce" required/>
            </div>

            <div class="form-group">
                <label for="date_depot">Date de depot de l'annonce :</label>
                <input type="date"  name="date_depot" value="<?= date("Y-m-d") ?>" class="form-control" id="date_depot" required/>
            </div>


            <div class="form-group">
                <label for="categorie_id">Catégorie de l'annonce :</label>
                <select name="categorie_id" class="form-control">
                    <?php
                    showAllCategories();
                    ?>
                </select>
            </div>
            <input type="hidden" value="<?= $_SESSION['id_utilisateur'] ?>" name="id_utilisateur">


            <div class="form-group">
                <label for="regions_id">Région de l'annonce :</label>
                <select name="regions_id" class="form-control">
                    <?php
                    listerRegions()
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="photo_annonce">Photos de l'annonce :</label>
                <span class="d-flex justify-content-center">
                <input type="file"  name="photo_annonce" class="form-control-file" accept="image/gif, image/png, image/jpeg, image/svg, image/bmp, image/webp " placeholder="Photos 1 de votre annonce" id="photo_annonce1" required/>
            </span>
            </div>

            <div class="form-group">
                <button name="btn_ajouter_annonce" class="btn btn-info">Publier votre annonce</button>
            </div>
        </form>

    </div>
    <?php
    //Upload de la photo
    if(isset($_FILES['photo_annonce'])){
        $repertoire = "../public/img/";
        $photo_annonce = $repertoire . basename($_FILES['photo_annonce']['name']);
        $_POST['photo_annonce'] = $photo_annonce;
        if(move_uploaded_file($_FILES['photo_annonce']['tmp_name'], $photo_annonce)){
            echo "<p class='alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
        }else{
            echo "<p class='alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
        }
    }else{
        echo "<p class='alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
    }

}else{
    header("location: connexion_users");
}

?>