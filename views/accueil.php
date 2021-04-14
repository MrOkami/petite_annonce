<!------------ Carte de france --------------------->
<div class="container-fluid text-center mt-3">
    <h3 class="text-center">Quel est votre région :</h3>
    <link rel="stylesheet" href="public/map/cmap/style.css">
    <script src="public/map/cmap/jquery-1.11.1.min.js"></script>
    <script src="public/map/cmap/France-map.js"></script>
    <script>
        francefree();
    </script>
</div>

<div class="row mt-3">
    <?php
    foreach ($recupAnnonce as $data) {
        ?>
        <div class="col-sm-12 col-lg-4 mt-2">
            <div id="annonce-card" class="card">
                <h3 class="text-success p-4"><?= $data['nom_annonce'] ?> N° : <?= $data['id_annonce'] ?></h3>
                <img class="card-img-top img-fluid" src="~/<?= $data['photo_annonce'] ?>"
                     alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['nom_annonce'] ?></h5>
                    <p class="card-text"><b>Description :</b></p>
                    <p><?= $data['description_annonce'] ?></p>
                    <p><b>Prix : </b><?= $data['prix_annonce'] ?> €</p>
                    <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                    <p><b>Nom du vendeur : </b><?= $data['email_utilisateur'] ?></p>
                    <p><b>Région : </b><?= $data['nom_region'] ?></p>
                    <?php
                    $date_depot = new DateTime($data['date_depot']);
                    ?>
                    <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>

                    <a href= "details_annonce&id_details=<?= $data['id_annonce'] ?>" class= "btn btn-outline-success mt-2">Détails de l' annonce</a>

                    <?php
                    if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true ){
                        ?>
                        <a href="acheter&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-2">Acheter</a>
                        <?php
                    }else{
                        ?>
                        <a href="connexion_users&id=<?= $data['utilisateur_id'] ?>" class="btn btn-info mt-2">Acheter</a>
                        <?php
                    }
                    ?>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success mt-2" data-toggle="modal" data-target="#numero&id=<?= $data['id_annonce'] ?>">
                        CONTACT
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="numero&id=<?= $data['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CONTACT VENDEUR</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group active">
                                        <li class="list-group-item">Email : <?= $data['email_utilisateur'] ?></li>
                                        <li class="list-group-item">N° de téléphone : <?= $data['nom_utilisateur'] ?></li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <a href="email_vendeur&id=<?= $data['utilisateur_id'] ?>" class="btn btn-primary mt-2">Message</a>


                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <?php
    }
    ?>
</div>