<?php

use controllers\DB;

require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/DB.php';

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_password_confirm = $_POST['user_password_confirm'];
$isAdmin = $_POST['isAdmin'];

$messageToBeDisplayed = [];
$db = new DB();

//check if the email is already in use
$emailValidation = $db->validateIfEmailIsAlreadyBeingUsed($user_email);
if ($emailValidation){
    $messageToBeDisplayed[] = "email";
}

//check if the passwords match
if ($user_password !== $user_password_confirm){
    $messageToBeDisplayed[] = "password";
}

if (!empty($messageToBeDisplayed)){
    echo json_encode($messageToBeDisplayed);
    return false;
}

if($isAdmin == "true"){
    $isAdminAux = "1";
}else{
    $isAdminAux = "0";
}

$updatedUser = $db->updateUser($user_id, $user_name, $user_email, $user_password, $isAdminAux);
if ($updatedUser){
    session_start();
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_isAdmin'] = $isAdminAux;

    $messageToBeDisplayed[] = "success";
    echo json_encode($messageToBeDisplayed);
}
