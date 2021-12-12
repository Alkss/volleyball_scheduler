<?php

use controllers\DB;

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

$db = new DB();
switch ($_POST['action']){
    case "add":
        $db->addPlayer($_POST['id']);
        break;

    case "remove":
        session_start();
        $db->removePlayer($_POST['id'], $_SESSION['user_id']);
        break;

    default:
        //do nothing
        return false;
}