<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/image.php');

// instantiate database and tour object
$database = new Database();
$db = $database->getConnection();

$image = new Image($db);

$stmt = $image->read_maps();

$num = $stmt->rowCount();

if($num>0){
    
    $map_arr=array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){                        
        array_push($map_arr, $row['value']);
    }
    
    http_response_code(200);
    echo json_encode($map_arr);
    
}
else{
    
    http_response_code(404);
    echo json_encode(
        array("message" => "No maps found.")
        );
}
?>