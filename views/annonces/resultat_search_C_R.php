<div>
    <h1 class="text-warning">Resultat de la recherche</h1>
    <div class="row">

        <?php
        foreach ($resultsC_R as $row){
            ?>

            <div class="col-sm-12 col-lg-4 mt-2">
                <div id="annonce-card" class="card">
                    <img class="card-img-top img-fluid" src="~/<?= $row['photo_annonce'] ?>" alt="<?= $row['nom_annonce'] ?>" title="<?= $row['nom_annonce'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nom_annonce'] ?></h5>
                        <p class="card-text"><b>Description :</b></p>
                        <p><?= $row['description_annonce'] ?></p>
                        <p><b>Prix : </b><?= $row['prix_annonce'] ?> €</p>
                        <p>Catégories : <?= $row['type_categorie'] ?></p>
                        <p>Nom du vendeur : <?= $row['email_utilisateur'] ?></p>
                        <p>Regions : <?= $row['nom_region'] ?></p>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#numero&id=<?= $row['id_annonce'] ?>">
                            CONTACT
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="numero&id=<?= $row['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Contact vendeur</h5>
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

                        <a href="email_vendeur&id=<?= $row['utilisateur_id'] ?>" class="btn btn-outline-primary mt-3">Message</a>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
