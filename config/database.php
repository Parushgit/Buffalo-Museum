<?php
class Database{
    
    //private $config = parse_ini_file("config.ini");    
    private $host = "tethys.cse.buffalo.edu";
    private $db_name = "test";
    private $username = "mariyahh";
    private $password = "ChangeMe";
    public $conn;
    
    // get the database connection
    public function getConnection(){
        
        $this->conn = null;
        
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}
?>