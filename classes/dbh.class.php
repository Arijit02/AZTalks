<?php

    class Dbh{
        private $host = "localhost";
        private $userName = "arijit";
        private $pwd = "#Arijit02";
        private $dbName = "aztalks";

        protected function connect(){
            try{
                $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName.";charset=utf8mb4";
                $pdo = new PDO($dsn, $this->userName, $this->pwd);
                $pdo->setAttribute (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }

?>