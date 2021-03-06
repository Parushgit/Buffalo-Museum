<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once ('../config/http_response.php');
include_once '../objects/content.php';
include_once ('../objects/add.php');


// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$content = new Content($db);

// set age property of record to read
$content->tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die();

$image = $content->read_image();
$seq_array = $content->read_sequence();

$tours_arr=array();
$tours_arr["items"]=array();
$ques_array=array();

$index_array = array();

$tours = array();
//$tours["tour"] = array();

if(sizeof($seq_array)>0){
    foreach($seq_array as $sequence){
        $ques_array=array();
        
        $content->seq = $sequence;
        $description = $content->read_description();
        $ques_arr = $content->read_questions();
        $cord = $content->read_cord();
        
        $text_array = array();
        $text_array["text"] = array();
        
        array_push($text_array["text"],$description);
      
        foreach($ques_arr as $question){
            $content->ref_id = $question['id'];
            
            $correct_answer = $content->read_correct();
            $answers = $content->read_answers();
            
            $ans_arr = array();
            
            foreach($answers as $answer){
                
                $ans_element = explode("-",$answer);
                array_push($ans_arr, $ans_element[1]);
            }
            
            $ques_item = array(
                
                "question" => $question['value'],
                "answers" => $ans_arr,
                "correct_answer" => $correct_answer,
                
            );
            
            array_push($ques_array, $ques_item);
        }
              
        $tour_item=array(
            "img" => $image,
            "cord" => $cord,
            "text" => $text_array["text"],
            "questions" => $ques_array,
        );
        array_push($tours_arr["items"], $tour_item);
        
    }
    
    echo json_encode($tours_arr);
    
    http_response_code(200);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user product does not exist
    echo json_encode(array("message" => "Tour details do not exist."));
}
?>