<?php
class Tour{
    
    // database connection and table name
    private $conn;
    private $table_name = "Tours";
    
    // object properties
    public $id;
    public $name;
    public $type;
    public $image;
    public $status;
    public $age_group;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    
    //read tours.
    function read(){
        
        if(sizeof($this->age_group) == 1){
            $query = "SELECT *
                FROM ".$this->table_name." where status='active' and
                    age_group=".$this->age_group."";
        } else if(sizeof($this->age_group) > 1){
           
            $age_array = $this->age_group;
            
            $query = "SELECT *
                FROM ".$this->table_name." where status='active' and
                    (age_group=".$age_array[0]." or age_group = ".$age_array[1].")";
            
        }
              
        $stmt = $this->conn->prepare($query);        
        $stmt->execute();        
        return $stmt;
    }
    
    //read tours.
    function read_without_age(){
        
        $query = "SELECT * FROM ".$this->table_name." where status='active' ";       
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
        
    }
    
    //read all tours.
    function read_all(){
        
        $query = "SELECT *
                FROM ".$this->table_name." ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    //update status of tours.
    function update_status(){

        $query = "UPDATE ".$this->table_name."
                        SET status = '".$this->status."'
        where id=".$this->id."";
        $stmt = $this->conn->prepare($query);        
        $stmt->execute();        
        return $stmt;
    }
    
}