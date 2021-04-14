<?php
require_once "DatabaseModel.php";

class CategorieModel extends DatabaseModel
{
    private $id_categorie;
    private $type_categorie;

    //Permet de lister les categories dans un SELECT options
    public function showCategorie(){
        $db = $this->getPDO();
        $sql = "SELECT * FROM categories";
        $categories = $db->query($sql);
        return $categories;
    }
}