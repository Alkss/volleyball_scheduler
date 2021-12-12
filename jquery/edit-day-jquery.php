<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

use controllers\DB;

$db = new DB();
$db->updateDay($_POST['id'], $_POST['owner'], $_POST['dayWeekId']);
