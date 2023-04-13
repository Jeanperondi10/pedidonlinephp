<?php 
    class Database {
        private $host = "mariadb"; 
        private $database_name = "database";  
        private $username = "user"; 
        private $password = "password";

        public $conn;

 
        public function getConnection() {
 
            $this->conn = null;
     
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            
            return $this->conn;
        }
    }  
    
?>