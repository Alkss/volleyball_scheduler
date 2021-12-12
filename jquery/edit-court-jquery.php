<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

use controllers\DB;

session_start();
$db = new DB();

$dayWeek = $_POST['day_week'];
$owner = $_POST['owner'];
$courtId = $_POST['court_id'];
$dateInput = $_POST['dateInput'];
$scheduleInput = $_POST['scheduleInput'];
$isOpen = $_POST['isOpen'];
$isSchedule = $_POST['schedule'];
$maxPlayers = $_POST['max_players'];

$isOpen == "true" ? $isOpen = "1" : $isOpen = "0";
$isSchedule == "true" ? $isSchedule = "1" : $isSchedule = "0";

$insertData = $db->updateCourt($dayWeek, $dateInput, $isOpen, $isSchedule, $scheduleInput, $maxPlayers, $owner, $courtId);
