<?php
require_once "DatabaseModel.php";

class AnnoncesModel extends DatabaseModel
{
    //colones de la table annonce
    private $id_annonce;
    private $nom_annonce;
    private $description_annonce;
    private $prix_annonce;
    private $date_depot;
    private $photo_annonce;
    private $categorie_id;
    private $utilisateur_id;
    private $region_id;

    /***************************************************************
    ******************** POUR LES VISITEUR *************************
    ***************************************************************/

    public function showAllAnnonces(){
        $db = $this->getPDO();

        //Appel de la clé $_GET['page']
        //index.php?url=quelque_chose?page=1
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = "page=1";
        }
        //Nbr d'annonce affiché par page
        $limite = 3;
        //valeur de départ page courante - 1 * nbr d'annonce à affiché
        $debut = ($page - 1) * $limite;

        //requete SSQL + limite
        $sql = "SELECT * FROM petite_annonces.annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions ORDER BY Rand() ASC LIMIT {$limite} OFFSET {$debut}";
        $stmt = $db->query($sql);

        //requete qui compte le nombre d'entree
        $resultFoundRows = $db->query('SELECT COUNT(id_annonce) FROM annonces');
        //extrcct du nombre de jeu de resultat
        $nbrElementsTotal = $resultFoundRows->fetchColumn();
        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
        * vers la précédente. On va donc ne l'afficher que si on est sur une autre
        * page que la première */
        $nbrPages =  ceil($nbrElementsTotal / $limite);
        ?>

<div class="jumbotron justify-content-center">
    <nav aria-label="page navigation">
        <ul class="pagination">
            <?php
            if($page > 1):
                ?><li class="page-item"><a class="page-link" href="?page=<?= $page - 1; ?> ">Page précéddente</a></li>
            <?php
            endif;
            // on fait une boucle autant de fois qu'on a de page
            for ($i = 1; $i <= $nbrPages; $i++):
            ?><li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i;?></a></li>
            <?php
            endfor;
            /* Avec le nombre total de pages, on peut aussi masquer le lien
             * vers la page suivante quand on est sur la dernière
             */
            if($page < $nbrPages):
            ?><li class="page-item"><a class="page-link" href="?page=<?= $page + 1;?>">Page suivante</a></li>
            <?php
            endif;
            ?>
        </ul>
    </nav>
</div>
    <?php
        return $stmt;

    }

    /***************** Afficheer les annonces au format json ****************************/

    public function annonceJson(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions";
        $json = $db->query($sql);
        return $json;
    }


    /***********************************************************
    ****************** Pour les Inscrits ***********************
    ***********************************************************/
    //Afficher toutes les annonces par utilisateur
    public function showAnnonceParUser(){
        $db = $this->getPDO();

        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE utilisateur_id = ?";
        $this->id_annonce = $_SESSION['id_utilisateur'];

        $request = $db->prepare($sql);
        $request->bindParam(1, $this->id_annonce);
        $request->execute();

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function  showDetailsAnnonce(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE id_annonce = ?";

        $this->id_annonce = $_GET['id_details'];

        $request = $db->prepare($sql);
        $request->bindParam(1, $this->id_annonce);
        $request->execute();

        $details = $request->fetch(PDO::FETCH_ASSOC);
        return $details;
    }

    //compte le nombre d'annonce

    public function countAnnonce() {
        $db = $this->getPDO();
        $limite = 2;
        //requete qui compte le nbr d'entree
        $resultFoundRows = $db->query('SELECT COUNT (id_annonce) FROM annonces');
        $nbrElementsTotal = $resultFoundRows->fetchColumn();
        /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
        * vers la précédente. On va donc ne l'afficher que si on est sur une autre
        * page que la première */
        $nbrPages = ceil($nbrElementsTotal / $limite);
        return $nbrPages;
    }

    //passage de param dans la methode et assignation au variables du formulaire
    public function addAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id){
        $db = $this->getPDO();
        //les private
        $this->nom_annonce = $nom_annonce;
        $this->description_annonce = $description_annonce;
        $this->prix_annonce = $prix_annonce;
        $this->date_depot = $date_depot;
        $this->photo_annonce = $photo_annonce;
        $this->categorie_id = $categorie_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->region_id = $region_id;

         $sql = "INSERT INTO `annonces`(`nom_annonce`, `description_annonce`, `prix_annonce`, `photo_annonce`, `date_depot`, `categorie_id`, `utilisateur_id`, `regions_id`) VALUES (?,?,?,?,?,?,?,?)";

         $insert = $db->prepare($sql);

         $insert->bindParam(1,$nom_annonce);
         $insert->bindParam(2, $description_annonce);
         $insert->bindParam(3, $prix_annonce);
         $insert->bindParam(4, $photo_annonce);
         $insert->bindParam(5, $date_depot);
         $insert->bindParam(6, $categorie_id);
         $insert->bindParam(7, $utilisateur_id);
         $insert->bindParam(8, $region_id);

         $insert->execute(array($nom_annonce, $description_annonce, $prix_annonce, $photo_annonce, $date_depot, $categorie_id, $utilisateur_id, $region_id));

         return $insert;
    }

    //delete une annonce par user
    public function deleteAnnonce(){
        $db = $this->getPDO();
        $sql = "DELETE FROM annonces WHERE id_annonce = ?";

        $stmt = $db->prepare($sql);
        $this->id_annonce = $_GET['id_suppr'];
        $stmt->bindParam(1, $this->id_annonce);

        $delete = $stmt->execute();

        return $delete;
    }

    //editer une annonce
    public function editerAnnonce($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id){
        $db = $this->getPDO();

        $this->nom_annonce = $nom_annonce;
        $this->description_annonce = $description_annonce;
        $this->prix_annonce = $prix_annonce;
        $this->date_depot = $date_depot;
        $this->photo_annonce = $photo_annonce;
        $this->categorie_id = $categorie_id;
        $this->utilisateur_id = $utilisateur_id;
        $this->region_id = $region_id;
        $this->id_annonce = $id;

        $nom_annonce = $_POST['nom_annonce'];

        $sql = "UPDATE `annonces` SET `nom_annonce`= ?,`description_annonce`= ?,`prix_annonce`= ?,`photo_annonce`= ?,`date_depot`= ?,`categorie_id`= ?,`utilisateur_id`= ?,`regions_id`= ? WHERE id_annonce = ?";
        $request = $db->prepare($sql);
        $request->execute(array($nom_annonce, $description_annonce, $prix_annonce, $date_depot, $photo_annonce, $categorie_id, $utilisateur_id, $region_id, $id));
        return $request;
    }

    public function searchAnnonceMotCle(){
        $db = $this->getPDO();

        if(isset($_POST['recherche'])){
            $recherche = $_POST['recherche'];
        }else{
            $recherche = "";
            if(empty($recherhce)){
                echo "<p class='alert alert-danger'>Merci de remlir le champ de recherche</p>";
            }
        }
        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE nom_annonce LIKE '%$recherche%' OR description_annonce LIKE '%$recherche%' OR prix_annonce LIKE '%$recherche%' OR type_categorie LIKE '%$recherche%' OR nom_region LIKE '%$recherche%'";
        $results = $db->query($sql);
        return $results;
    }

    //Afficher les détails de l'annonce par regions et categories
    public function getAnnonceByRandC(){
        $db = $this->getPDO();

        //Recup de input recherche
        if(isset($_POST['categorie_id']) && isset($_POST['region_id'])){
            $cat = $_POST['categorie_id'];
            $reg = $_POST['region_id'];
        }else{
            $cat = 1;
            $reg = 1;
            if(empty($cat) || empty($reg)){
                echo "<p class='alert-danger mt-2 p-2'>Merci de remplir les champs Catégorie et Région</p>";
            }
        }


        $sql = "SELECT * FROM annonces INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id_utilisateur INNER JOIN  categories ON annonces.categorie_id = categories.id_categorie INNER JOIN regions ON annonces.regions_id = regions.id_regions WHERE regions_id = ? AND categorie_id = ? ";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $_POST['region_id']);
        $stmt->bindParam(2, $_POST['categorie_id']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }











}