<?php
class Content{
    
    // database connection and table name
    private $conn;
    private $table_name = "resource";
    
    // object properties
    public $id;
    public $age_group;
    public $tour_id;
    public $type;
    public $value;
    public $lang;
    public $seq;
    public $ref_id;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    // read products
    function read(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where 
                    tour_id = ".$this->tour_id." and age_group = '".$this->age_group."'  ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
}