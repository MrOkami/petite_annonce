<?php


class DatabaseModel
{
    private $db_host = "localhost";
    private $db_name = "petite_annonces";
    private $db_user = "root";
    private $db_pass = "";

    protected $isConnected;

    public function getPDO(){
        $this->isConnected = null;
        if ($this->isConnected === null){
            try{
                $this->isConnected = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name.";charset=utf8", $this->db_user, $this->db_pass);

                //debug PDO
                $this->isConnected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->isConnected;
            }catch (PDOException $exception){
                echo "erreur de connexion à PDO";
                die();
            }
        }
    }
}