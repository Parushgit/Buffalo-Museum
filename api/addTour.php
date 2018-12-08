<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// include database and object files
include_once ('../config/database.php');
include_once ('../config/http_response.php');
include_once ('../objects/tour.php');
include_once ('../objects/add.php');
include_once ('../objects/age.php');

// get database connection
$database = new Database();
$db = $database->getConnection();

    $raw = urldecode(file_get_contents("php://input"));
    $data = explode("=", $raw);
    $input = json_decode($data[1],true);
   
    
    
//$print_r($input);
/*
$answers_array_input = array();
array_push($answers_array_input,"yes");
array_push($answers_array_input,"no");

$item_in = array();

$question_in = array();

$quesns = array(
    question => "Do you want to add?",
    answers => $answers_array_input,
    correct_answer => "0",
);

array_push($question_in,$quesns);

$items = array(
    img => "Map1.jpg",
    cord => "3-4",
    text => "test",
    questions => $question_in,
);

array_push($item_in, $items);

$input = array(
    
    tour_name => "Dino",
    tour_type => "quest",
    tour_thumbnail => "natural.jpg",
    tour_age_group => "4-12",
    items => $item_in,
    
); 

$x = json_encode($input);
print_r($x);

*/

$add = new Add($db);
$age = new Age($db);

$age_gr = $input["age_group"];
$age_array = explode("-", $age_gr);

$age->age_low = $age_array[0];
$age->age_high = $age_array[1];

$add->tour_id = $input["id"];
$add->tour_name = $input["name"];
$add->tour_type = $input["type"];
$add->tour_thumbnail = $input["path"];
$add->tour_age_group = $age->get_age_range_id();

//if tour exists, delete it.
if($add->tour_id != NULL){
    $add->delete_tour();
}
//insert the new tour.
$add->insert_tour();

$items = $input["items"];
$sequence = 1;

foreach($items as $in){
    //print_r($in);
    //add coordinates
    $add->insert_resource("cord", $in["cord"], $sequence, NULL);  
    
    //add image (one time as map doesn't change with sequence). TODO implement multiple maps in single tour
    if($sequence == 1){
        $add->insert_resource("img", $in["img"], $sequence, NULL);  
    }

    //add text
    $add->insert_resource("desc", $in["text"][0], $sequence, NULL);  
         
        $questions = $in["questions"];
        
        foreach ($questions as $q){
            
            $question = $q["question"];
            //print_r($question);
            //add question
            $q_id = $add->insert_resource("ques", $question, $sequence, NULL);              
            
            $answers = $q["answers"];
            
            $index = 0;
            if(sizeof($answers)>0){
            foreach($answers as $answer){
                //append index of answers
                //add answers
                $ans = "".$index."-".$answer."";
                $add->insert_resource("ans", $ans, $sequence, $q_id); 
                $index++;
            }
            }
            //add the correct answer
            $add->insert_resource("cans", $q["correct_answer"], $sequence, $q_id);     
        }
    
    $sequence++;   
}
http_response_code(200);
echo json_encode("OK");
?>