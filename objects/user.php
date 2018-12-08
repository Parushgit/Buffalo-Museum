<?php
class User{
    
    // database connection and table name
    private $conn;
    private $table_name = "User_Table";
    
    // object properties
    public $email;
    public $pwd;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    
    //validate user.
    function validate(){
        
        $query = "SELECT count(*) as count
                FROM ".$this->table_name." where User_Email='".$this->email."' and User_Password='".$this->pwd."'";
        
        $stmt = $this->conn->prepare($query);        
        $stmt->execute();   
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $count = $row['count'];
        }
        return $count;
    }
    
}