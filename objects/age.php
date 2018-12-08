<?php
class Age{
    
    // database connection and table name
    private $conn;
    private $table_name = "Age_Groups";
    
    // object properties
    public $id;
    public $age;
    public $age_low;
    public $age_high;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
       
    // read age groups.
    function read_age_groups(){
        
        // select all query
        $query = "SELECT * 
                FROM ".$this->table_name." ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $arr=array();
               
        for($i = 0;$i<$num;$i++){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $age_low = $row['age_low'];
            $age_high = $row['age_high'];
            if($age_high == NULL){
                $age = "".$row['age_low']."+";
            }
            else{
                $age = "".$row['age_low']."-".$row['age_high']."";
            }
            array_push($arr, $age);
        }
        return $arr;
    }
    
    // read age group id.
    function get_age_id(){
        
        // select all query
        $query = "SELECT id
                FROM ".$this->table_name." where ".$this->age." between 
                    coalesce(age_low,".$this->age.") 
                         and coalesce(age_high,".$this->age.") ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        
        $id = array();
        
        for($i = 0;$i<$num;$i++){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($id, $row['id']);
        }
        return $id;
    }
    
    // read age group id.
    function get_age_range_id(){
        
        // select all query
        $query = "SELECT id
                FROM ".$this->table_name." where age_low = ".$this->age_low." 
                            and age_high=".$this->age_high." ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $id = 0;
        for($i = 0;$i<$num;$i++){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
        }
        return $id;
    }
      
    // read age group id.
    function get_range_by_id(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where id = ".$this->id." ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $age_range = "NULL";
        for($i = 0;$i<$num;$i++){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $age_low = $row['age_low'];
            $age_high = $row['age_high'];
            $age_range = "".$age_low."-".$age_high."";                      
        }
        return $age_range;
    }
}