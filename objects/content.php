<?php
class Content{
    
    // database connection and table name
    private $conn;
    private $table_name = "Resources";
    
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
    function read_image(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." and type = 'img'  ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // set values to object properties
        $image_path = $row['value'];
        // execute query
        return $image_path;
    }
    
    // read products
    function read_sequence(){
        
        // select all query
        $query = "SELECT DISTINCT(seq)
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." order by id";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $seq_arr=array();
        
        if($num > 0){
            // sequence array
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $sequence = $row['seq'];
                if($sequence>0){
                    array_push($seq_arr, $sequence);
                }
            }
        }
        return $seq_arr;     
    }
    
    // read products
    function read_description(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." and seq = ".$this->seq."
                        and type = 'desc'";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['value'];
        
    }
    
    // read products
    function read_cord(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id."  
                        and seq = ".$this->seq." and type = 'cord'";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['value'];
        
    }
    
    // read products
    function read_questions(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." 
                        and seq = ".$this->seq." and type='ques' order by id";
        
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $ques_arr=array();
        
        if($num > 0){
            // sequence array
            $ques_arr=array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                //print_r($row);
                $q_item = array(
                    "id" => $row['id'],
                    "value" => $row['value'],
                );
                array_push($ques_arr, $q_item);
            }
        }
        //print_r($ques_arr);
        return $ques_arr;       
    }
    
    // read products
    function read_answers(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." 
                        and type ='ans' and ref_id=".$this->ref_id." and seq = ".$this->seq."
                                        order by id";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $ques_arr=array();
        
        if($num > 0){
            // sequence array
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($ques_arr, $row['value']);
            }
        }
        //print_r($seq_arr);
        return $ques_arr;
    }
    
    // read products
    function read_correct(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id." 
                        and type = 'cans' and ref_id=".$this->ref_id."  ";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // set values to object properties
        $correct_answer = $row['value'];
        // execute query
        return $correct_answer;
    }
    
    // read comments for a given tour.
    function read_comments(){
        
        // select all query
        $query = "SELECT *
                FROM ".$this->table_name." where
                    tour_id = ".$this->tour_id."
                        and type ='comm' order by id";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $arr=array();
                
        for($i = 0;$i<$num;$i++){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            array_push($arr, $row['value']);            
        }
        
        return $arr;
    }
     
}