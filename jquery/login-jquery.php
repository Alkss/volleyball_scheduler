<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']. "/Validator.php";

$response= Validator::validateLogin($_POST['email'], $_POST['password']);
if ($response){
    $_SESSION = [
        "user_id" => $response['id'],
        "user_email" => $response['email'],
        "user_name" => $response['name'],
        "user_isAdmin" => $response['isAdmin']
    ];
}
echo json_encode($response);
