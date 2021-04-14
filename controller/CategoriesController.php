<?php
require_once "../models/CategorieModel.php";

//Fonction à appeller depuis add_annonces.php

function showAllCategories(){
    $categorie = new CategorieModel();
    $listeCategorie = $categorie->showCategorie();
    ?>
    <option class="text-success"  value="">Choix de la catégories :</option>
    <?php
    foreach ($listeCategorie as $cat){
        ?>
        <option value="<?= $cat['id_categorie'] ?>"><?= $cat['type_categorie'] ?></option>
        <?php
    }
    return $listeCategorie;
}