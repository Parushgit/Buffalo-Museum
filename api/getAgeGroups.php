<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/age.php');

// instantiate database and tour object
$database = new Database();
$db = $database->getConnection();

$age = new Age($db);

$age_arr = $age->read_age_groups();

if(sizeof($age_arr)>0){
    http_response_code(200);
    echo json_encode($age_arr);
} else{
    http_response_code(404);
    echo json_encode("Age groups not found.");
}
    
?>