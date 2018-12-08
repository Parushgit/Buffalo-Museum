<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/tour.php');

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$tour = new Tour($db);

$tour->id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die();
$tour->status = isset($_GET['status']) ? $_GET['status'] : die();

error_log($tour->id,0);
error_log($tour->status,0);

$stmt = $tour->update_status();

if($stmt){ 
    
    http_response_code(200);
    echo json_encode("OK");
    
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