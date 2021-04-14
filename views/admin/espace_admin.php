<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
</head>

<?php
if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true) {
    ?>
    <h1 class="text-success">ESPACE ADMINISTRATION</h1>
    <h2 class="text-secondary">BIENVENUE <?= $_SESSION['email_admin'] ?></h2>
    <a href="deconnexion" class="btn btn-outline-danger mt-3">Deconnexion espace administration</a>
    <!--TABLE ADMIN-->
    <div class="jumbotron mt-3">
        <h3 class="text-warning">TABLE DES ADMINISTRATEURS :</h3>
        <a href="add_admin" class="btn btn-outline-success">Ajouter un administrateur</a>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email Admin</th>
                <th>Mot de passe Admin</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableAdmin as $admin){
                ?>
                <tr>
                    <td><?= $admin['id_admin'] ?></td>
                    <td><?= $admin['email_admin'] ?></td>
                    <td><?= $admin['password_admin'] ?></td>
                    <!-- MODAL SUPPRIMER -->
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#supprimer_admin&id_suppr=<?= $admin['id_admin'] ?>">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="delete_admin&id_suppr=<?= $admin['id_admin'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID = <?= $admin['id_admin'] ?></p>
                                        <p>Email = <?= $admin['email_admin'] ?></p>
                                        <p>Mot de passe = <?= $admin['password_admin'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="delete_admin&id_suppr=<?= $admin['id_admin'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <!--TABLE UTILISTEURS-->

    <div class="jumbotron mt-3">
        <h3 class="text-warning">TABLE DES UTILISATEURS :</h3>
        <table id="tableUsers" class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Numero de telephone</th>
                <th>Email</th>
                <th>Mot de passe</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableUtilisateurs as $data){
                ?>
                <tr>
                    <td>ID: <?= $data['id_utilisateur'] ?></td>
                    <td><?= $data['nom_utilisateur'] ?></td>
                    <td><?= $data['email_utilisateur'] ?></td>
                    <td><?= $data['password_utilisateur'] ?></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#delete_user&id_suppr=<?= $data['id_utilisateur'] ?>">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="delete_user&id_suppr=<?= $data['id_utilisateur'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID : <?= $data['id_utilisateur'] ?></p>
                                        <p>N° Téléphone : <?= $data['nom_utilisateur'] ?></p>
                                        <p>Email : <?= $data['email_utilisateur'] ?></p>
                                        <p>Mot de passe : <?= $data['password_utilisateur'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="delete_admin_user&id_suppr=<?= $admin['id_admin'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <!--TABLE ANNONCES-->
    <div class="jumbotron mt-3">

        <h3 class="text-warning">TABLE DES ANNONCES :</h3>
        <table id="tableAnnonce" class="table table-striped mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom annonce</th>
                <th>Description annonce</th>
                <th>Prix annonce</th>
                <th>Photo annonce</th>
                <th>Date dépot annonce</th>
                <th>Catégorie annonce</th>
                <th>Propriétaire annonce</th>
                <th>Région annonce</th>
                <th>Supprimer annonce</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableAnnonce as $admin){
                ?>
                <tr>
                    <td><?= $admin['id_annonce'] ?></td>
                    <td><?= $admin['nom_annonce'] ?></td>
                    <td><?= $admin['description_annonce'] ?></td>
                    <td><?= $admin['prix_annonce'] ?></td>
                    <td><img width="100%" src="~/<?= $admin['photo_annonce'] ?>" alt="<?= $admin['nom_annonce'] ?>" title="<?= $admin['nom_annonce'] ?>"/></td>
                    <td><?= $admin['date_depot'] ?></td>
                    <td><?= $admin['type_categorie'] ?></td>
                    <td><?= $admin['email_utilisateur'] ?></td>
                    <td><?= $admin['nom_region'] ?></td>
                    <!-- MODAL SUPPRIMER -->
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#supprimer_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="delete_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID = <?= $admin['id_annonce'] ?></p>
                                        <p>Nom = <?= $admin['nom_annonce'] ?></p>
                                        <p>Description = <?= $admin['description_annonce'] ?></p>
                                        <p>Prix = <?= $admin['prix_annonce'] ?></p>
                                        <p><img width="25%" src="~/<?= $admin['photo_annonce'] ?>"/></p>
                                        <p>Date de depot = <?= $admin['date_depot'] ?></p>
                                        <p>Catégorie = <?= $admin['type_categorie'] ?></p>
                                        <p>Propriétaire = <?= $admin['email_utilisateur'] ?></p>
                                        <p>Région = <?= $admin['nom_region'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="delete_annonce_admin&id_suppr=<?= $admin['id_annonce'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Tabulator -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <div class="jumbotron mt-3">
        <h3 class="text-warning">TABLE DES REGIONS :</h3>
        <table id="tableRegion" class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nom de la région</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableRegion as $data){
                ?>
                <tr>
                    <td>ID: <?= $data['id_regions'] ?></td>
                    <td><?= $data['nom_region'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="jumbotron mt-3">
        <h3 class="text-warning">TABLE DES CATEGORIES :</h3>
        <a href="add_categorie" class="btn btn-success mt-3 mb-3">Ajouter une catégorie</a>
        <table id="tableCategorie" class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Type de catégories</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tableCategorie as $data){
                ?>
                <tr>
                    <td>ID: <?= $data['id_categorie'] ?></td>
                    <td><?= $data['type_categorie'] ?></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#delete_categorie_admin&id_suppr=<?= $data['id_categorie'] ?>">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="delete_categorie_admin&id_suppr=<?= $data['id_categorie'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID = <?= $data['id_categorie'] ?></p>
                                        <p>Type de cotégorie = <?= $data['type_categorie'] ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <a href="delete_categorie_admin&id_suppr=<?= $data['id_categorie'] ?>" type="button"
                                           class="btn btn-primary">Confirmer la suppression</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>


    <script>
        $('#tableAnnonce,#tableRegion,#tableCategorie, #tableUtilisateurs').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });


    </script>


    <?php

} else {
    header("location: accueil?page=1");
}