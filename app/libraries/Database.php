<?php
    include("../config/config.php");
    class Database{
        private $db_name = DB_NAME;
        private $db_user = "userhiba";
        
        private $connexion;
        private  $statement;
        

        public function __construct(){
            $this->connexion=null;
            try{
                $this->connexion=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
            }
            catch(PDOException $exception){
                echo "PDO : ".$exception->getMessage();
            }
        }
        public function prepare($sql){
       
            return $this->statement = $this->connexion->prepare($sql); 
     
        }
        public function execute(){
            $this->statement->execute();
        }

        public function single(){
            $this->execute();    
            return $this->statement->fetch();
        }

        public function resultSet(){
            $this->execute();
            return $this->statement->fetchAll();
        }
        
        public function rowCount(){
            return $this->statement->rowCount();
        }
    }
    /*$db = new Database();
    $db->prepare("select * from doctors");
    $db->execute();
    var_dump($db->resultSet());*/