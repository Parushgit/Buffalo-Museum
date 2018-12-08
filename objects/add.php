<?php
class Add{
    
    // database connection and table name
    private $conn;
    private $tour_table = "Tours";
    private $resource_table = "Resources";
    
    // object properties
    public $tour_id;
    public $tour_name;
    public $tour_type;
    public $tour_status;
    public $tour_thumbnail;
    public $tour_age_group;
        
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;        
    }
    
    //delete tour if exists
    function delete_tour(){
        
        $query_tour = "DELETE FROM ".$this->tour_table." where id=".$this->tour_id."";
        $query_resource = "DELETE FROM ".$this->resource_table." where tour_id=".$this->tour_id."";
        
        $stmt_tour = $this->conn->prepare($query_tour);
        $stmt_resource = $this->conn->prepare($query_resource);
       
        $stmt_tour->execute();
        $stmt_resource->execute();
        
        return $stmt_tour;
        
    }
    
    //insert new tour
    function insert_tour(){
        
        $this->tour_id = $this->get_max_id($this->tour_table)  + 1;
        $this->tour_status = "inactive";
        
        $insert_query = "INSERT INTO `".$this->tour_table."` (`id`,`name`,`type`,`image`,`age_group`,`status`)
            values (".$this->tour_id.",'".$this->tour_name."','".$this->tour_type."',
                        '".$this->tour_thumbnail."',".$this->tour_age_group.",'".$this->tour_status."') "; 
        $stmt_insert = $this->conn->prepare($insert_query);
        
        // execute query
        $rs = $stmt_insert->execute();
        if(!$rs){
            die('Could not insert data: ');
        }
        
        return $this->tour_id;
    }
    
    //insert new resource
    function insert_resource($resource_type, $resource_value,
        $resource_sequence, $resource_reference_id){
        
            if(!$resource_reference_id){
                $resource_reference_id = "NULL";            
            }
            if(!$resource_sequence){
                $resource_sequence = "NULL";
            }
            
        $max_id = $this->get_max_id($this->resource_table) ;
        $resource_id = $max_id + 1;
        $insert_query = "INSERT INTO `".$this->resource_table."` (`id`,`type`,`value`,`seq`,`tour_id`,`ref_id`)
            values ($resource_id,'".$resource_type."','".$resource_value."',".$resource_sequence.",
                        ".$this->tour_id.",".$resource_reference_id.") ";
       
        $stmt_insert = $this->conn->prepare($insert_query);
        
        $result = $stmt_insert->execute();   
        if (!$result) {
            error_log('Could not insert data.');
        }
        return $resource_id;
    }
    
    //get max Id
    function get_max_id($table_name){
        
        $query = "SELECT MAX(id) as id
                FROM ".$table_name." ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $max_id = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //print_r($row['id']);
            $max_id = $row['id'];
        }
        
        return $max_id;
    }
}