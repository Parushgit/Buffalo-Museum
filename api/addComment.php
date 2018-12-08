<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/tour.php');
include_once ('../objects/add.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

$raw = urldecode(file_get_contents("php://input"));
$data = explode("=", $raw);
$input = json_decode($data[1],true);

$add = new Add($db);

$add->tour_id = $input["tour_id"];
$first = $input["firstname"];
$last = $input["lastname"];
$comment = $input["comment"];

$entry = "$first-$last-$comment";

//add comment
$id = $add->insert_resource("comm", $entry, NULL, NULL);  
if(!$id){
  http_response_code(200);
  echo json_encode("issue");
} else {
    http_response_code(200);
    echo json_encode("OK");
}

?>