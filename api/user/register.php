<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define("BASE_DIR", "../../");
include_once BASE_DIR.'/config/bootstrap.php';


$database = new Database();
$db = $database->connect();
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("message" => "Invalid Email"));
}else{
    if (!strlen($data->password) > 6) {
        echo json_encode(array('message'=> "Password length too short. Must be greater than 6"));
    }
    else{
        if(preg_match('/^[0-9]{11}+$/', $data->phone_number)){ 
            if($user->register()){
                $user_arr = array(
                    'status'=> true,
                    'message'=> 'Account created succesfully'
                );
            }
            echo json_encode($user_arr);
        }else{
            echo json_encode(array('message'=> 'Invalid phone number'));
        }
    }
}