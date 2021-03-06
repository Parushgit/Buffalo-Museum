<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/tour.php');
include_once ('../objects/age.php');


// instantiate database and tour object
$database = new Database();
$db = $database->getConnection();

$tour = new Tour($db);
$age = new Age($db);

$age->age = isset($_GET['age']) ? $_GET['age'] : die();

$stmt = null;

if($age->age == -1){
    $stmt = $tour->read_without_age();
} else{
    $tour->age_group = $age->get_age_id();
    $stmt = $tour->read();
}

$num = $stmt->rowCount();

if($num>0){
    
    $tours_arr=array();
    $tours_arr["tours"]=array();
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      
        extract($row);
                
        $tour_item=array(
            "id" => $id,
            "name" => $name,
            "type" => $type,
            "path" => $image,
            "age_group" => $age_group,
        );
        
        array_push($tours_arr["tours"], $tour_item);
    }
    
    http_response_code(200);
    echo json_encode($tours_arr);
    
}
else{
    
    http_response_code(404);
    echo json_encode(
        array("message" => "No tours found.")
        );
}
?>