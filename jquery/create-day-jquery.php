<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";
use controllers\DB;

$db = new DB();

$dayWeek = $_POST['dayWeek'];
$owner = $_POST['owner'];

$db->insertDay($dayWeek, $owner);
