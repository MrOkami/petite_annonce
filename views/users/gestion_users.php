<?php

if (isset($_SESSION['connecter_utilisateur']) && $_SESSION['connecter_utilisateur'] === true){

?>

<h1 class="alert alert-info text-center text-warning mt-3">GESTION DE VOS ANNONCES</h1>
<div id="user-dashboard">
    <a href="add_annonce" class="btn btn-success">Ajouter une annonce</a>
    <div class="row mt-3">
        <?php
        foreach ($nbrPages as $data){
        ?>

            <div class="col-sm-12 col-lg-4 mt-2">
                <div id="annonce-card" class="card">
                    <img class="card-img-top img-fluid" src="~/<?= $data['photo_annonce'] ?>"
                         alt="<?= $data['nom_annonce'] ?>" title="<?= $data['nom_annonce'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['nom_annonce'] ?></h5>
                        <p class="card-text"><b>Description :</b></p>
                        <p><?= $data['description_annonce'] ?></p>
                        <p><b>Prix : </b><?= $data['prix_annonce'] ?> €</p>
                        <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                        <p><b>Nom du vendeur : </b><?= $data['nom_utilisateur'] ?></p>
                        <p><b>Région : </b><?= $data['nom_region'] ?></p>

                        <?php
                        $date_depot = new DateTime($data['date_depot']);
                        ?>

                        <p><em>Date de dépot : <?= $date_depot->format('d-m-Y') ?></em></p>

                        <!--MODAL SUPPRIMER-->
                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#delete_annonce&id_suppr=<?= $data['id_annonce'] ?>">
                            Supprimer cette annonce
                        </button>

                        <a class="btn btn-outline-primary" href="editer_annonce&id_edit=<?= $data['id_annonce'] ?>">Editer cette annonce
                        </a>

                        <a href="details_annonce&id_details=<?= $data['id_annonce'] ?>" class="btn btn-outline-success mt-2">Détails de l' annonce</a>



                        <!-- Modal SUPPRIMER ANNONCES-->
                        <div class="modal fade" id="delete_annonce&id_suppr=<?= $data['id_annonce'] ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="text-center text-danger">ATTENTION</h1>
                                        <h2 class="text-warning text-center">Vous allez supprimer ce produit !</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h3 class="modal-title text-info text-center"
                                                    id="exampleModalLabel"><?= $data['nom_annonce'] ?></h3>
                                            </li>
                                            <li class="list-group-item text-center">
                                                <img src="~/<?= $data['photo_annonce'] ?>"
                                                     alt="<?= $data['nom_annonce'] ?>"
                                                     title="<?= $data['nom_annonce'] ?>" width="50%" class="img-fluid">
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Description : </b></p>
                                                <p><?= $data['description_annonce'] ?></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Prix : <?= $data['prix_annonce'] ?> €</b></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Catégorie : </b><?= $data['type_categorie'] ?></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Région : </b><?= $data['nom_region'] ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                                        </button>
                                        <a href="delete_annonce&id_suppr=<?= $data['id_annonce'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
            }else{
                header("Location: connexion_users");
            }



