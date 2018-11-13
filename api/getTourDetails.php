<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/content.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$content = new Content($db);

// set age property of record to read
$content->tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die();
$age = isset($_GET['age']) ? $_GET['age'] : die();

if($age >= 4 && $age <= 12){
    $content->age_group = "A";
} else if($age >12 && $age <= 17){
    $content->age_group = "B";
} else if($age >= 18){
    $content->age_group = "C";
}


// read the details of tour to be edited
$stmt = $content->read();
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
            "type" => $type,
            "age_group" => $age_group,
            "tour_id" => $tour_id,
            "type" => $type,
            "value" => $value,
            "lang" => $lang,
            "seq" => $seq,
            "ref_id" => $ref_id,
        );
        
        array_push($tours_arr["records"], $tour_item);
    }
    print_r($tours_arr);
    // set response code - 200 OK
    http_response_code(200);
    
    // show products data in json format
    //echo json_encode($tours_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user product does not exist
    echo json_encode(array("message" => "Tour details do not exist."));
}
?>