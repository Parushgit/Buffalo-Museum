<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../objects/tour.php');

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$tour = new Tour($db);
//print_r($tour);
// query products
$stmt = $tour->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    
    // products array
    $tours_arr=array();
    $tours_arr["records"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $tour_item=array(
            "id" => $id,
            "name" => $name,
            "type" => $type,
            "image" => $image,
            //"description" => html_entity_decode($description),
        );
        
        array_push($tours_arr["records"], $tour_item);
    }
    print_r($tours_arr);
    // set response code - 200 OK
    http_response_code(200);
    
    // show products data in json format
    echo json_encode($tours_arr);
}

else{
    
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
        );
}
?>