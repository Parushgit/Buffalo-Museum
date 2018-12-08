<?php
class Image{
    
    // database connection and table name
    private $conn;
    private $table_name = "Images";
    
    // object properties
    public $id;
    public $value;
    public $type;
    
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    
    //read tours.
    function read_maps(){
        
        $query = "SELECT *
                FROM ".$this->table_name." where type='map' ";
        
        $stmt = $this->conn->prepare($query);        
        $stmt->execute();        
        return $stmt;
    }
    
    //read all tours.
    function read_thumbnails(){
        
        $query = "SELECT *
                FROM ".$this->table_name." where type='thumbnail' ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
}