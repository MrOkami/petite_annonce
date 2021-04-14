<h1 class="alert-primary text-center text-info" id="annonceRe">Annonces de la region :</h1>
<div class="row">

    <?php
    foreach ($annonceParRegion as $row){
    ?>
    <div class="col-md-4 col-sm-12 mt-3">
        <div class="card"">
        <img width="10%" class="card-img-top img-fluid" src="~/<?= $row['photo_annonce'] ?>" alt="<?= $row['nom_annonce'] ?>" title="<?= $row['nom_annonce'] ?>">
        <div class="card-body">
            <h5 class="card-title"><b>Produits : </b><br /><?= $row['nom_annonce'] ?></h5>
            <p class="card-text"><?= $row['description_annonce'] ?></p>
            <p><b>Prix : </b><?= $row['prix_annonce'] ?> €</p>
            <p><b>Catégorie : </b><?= $row['type_categorie'] ?></p>
            <p><b>Nom du vendeur : </b><?= $row['nom_utilisateur'] ?></p>
            <p><b>Région du vendeur : </b><?= $row['nom_region'] ?></p>

            <?php
            if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                ?>
                <a href="acheter&id=<?= $row['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                <?php
            }else{
                ?>
                <a href="connexion_utilisateur&id=<?= $row['utilisateur_id'] ?>" class="btn btn-info mt-3">Acheter</a>
                <?php
            }
            ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#numero&id=<?= $row['id_annonce'] ?>">
                Contact
            </button>

            <!-- Modal -->
            <div class="modal fade" id="numero&id=<?= $row['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contact Vendeur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group active">
                                <li class="list-group-item">Email : <?= $row['email_utilisateur'] ?></li>
                                <li class="list-group-item">N° de téléphone : <?= $row['nom_utilisateur'] ?></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="email_vendeur&id=<?= $row['utilisateur_id'] ?>" class="btn btn-primary mt-3">Message</a>

        </div>
    </div>
</div>

<?php
}
?>
</div>

<?php
