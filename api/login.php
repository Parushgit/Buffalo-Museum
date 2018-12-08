<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

// include database and object files
include_once '../config/databaseUser.php';
include_once '../objects/user.php';
include_once '../config/http_response.php';

// get database connection
$database = new UserDatabase();
$db = $database->getConnection();

$user = new User($db);

$user->email = isset($_POST['adminEmail']) ? $_POST['adminEmail'] : die();
$user->pwd = isset($_POST['adminPwd']) ? $_POST['adminPwd'] : die();

$count = $user->validate();
if($count > 0) {
    http_response_code(200);
    echo "Success";
} else {
    http_response_code(404);
    echo "Failure";
}
?>
