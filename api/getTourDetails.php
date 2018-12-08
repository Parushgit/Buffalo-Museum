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
$tours_arr["comments"] = array();
$ques_array=array();

$index_array = array();
$index_array["0"] = "a";
$index_array["1"] = "b";
$index_array["2"] = "c";

$tours = array();
$tours["tour"] = array();

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
    
    $image_item = array(
        "img" => $image,
        "cord" => $cord,
    );   
    array_push($tours_arr["items"], $image_item);
    
    foreach($ques_arr as $question){
        $content->ref_id = $question['id'];
        
        $cans = $content->read_correct();
        $correct_answer = $index_array[$cans];
        
        $answers = $content->read_answers();

        $ans_arr = array();

        foreach($answers as $answer){
            
                $ans_element = explode("-",$answer);                
                $answer_option = $index_array[$ans_element[0]];                
                $ans_arr["$answer_option"] = $ans_element[1];
        }
               
        $ques_item = array(
            
            "question" => $question['value'],
            "answers" => $ans_arr,
            "correct_answer" => $correct_answer,
           
        );
        
        array_push($ques_array, $ques_item);
    }
    
       
    $tour_item=array(
        "text" => $text_array["text"],
        "questions" => $ques_array,
    );
    array_push($tours_arr["items"], $tour_item);
      
}

$comm_array = $content->read_comments();

foreach($comm_array as $comment){
    $comment_element = explode("-",$comment);
    $comment_text = $comment_element[2];
    $comment_user_firstname = $comment_element[0];
    $comment_user_lastname = $comment_element[1];
    
    $comment_item = array(
        
        "firstname" => $comment_user_firstname,
        "lastname" => $comment_user_lastname,
        "comment" => $comment_text,
        
    );
    
    array_push($tours_arr["comments"], $comment_item);
    
}

array_push($tours["tour"],$tours_arr);

echo json_encode($tours);

http_response_code(200);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user product does not exist
    echo json_encode(array("message" => "Tour details do not exist."));
}
?>