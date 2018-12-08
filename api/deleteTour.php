<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/add.php');

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$add = new Add($db);

$add->tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die();

$stmt = $add->delete_tour();

if($stmt){ 
    
    http_response_code(200);
    echo json_encode("OK");
    
}
else{
    
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no products found
    echo json_encode(
        array("message" => "Couldn't delete tour.")
        );
}
?>