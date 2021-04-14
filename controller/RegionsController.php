<?php
require_once "../models/RegionsModel.php";

function listerRegions(){
    $region = new RegionsModel();
    $afficher_region = $region->showAllRegions();
    ?>
    <option class="text-success" value="">Choix de la région :</option>
    <?php
    foreach ($afficher_region as $reg){
        ?>
        <option value="<?= $reg['id_regions'] ?>"><?= $reg['nom_region'] ?></option>
        <?php
    }
    return $afficher_region;
}

function annonceParRegion($id){
    $region = new RegionsModel();
    $annonceParRegion = $region->showAnnonceParRegion($_GET['id']);
    if ($annonceParRegion){
        require_once '../views/annonces/resultat_recherche_region.php';
    }else{
        echo "<p class='text-center' id='notAnnonce''><b>Pas d'annonce dans cette region</b></p>";
    }
}