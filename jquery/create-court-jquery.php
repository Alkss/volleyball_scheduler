<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

use controllers\DB;
session_start();
$db = new DB();

$dayWeek = $_POST['day_week'];
$dateInput = $_POST['dateInput'];
$scheduleInput = $_POST['scheduleInput'];
$isOpen = $_POST['isOpen'];
$isSchedule = $_POST['schedule'];
$maxPlayers = $_POST['max_players'];

$insertData = $db->insertNewCourt($dayWeek, $dateInput, $isOpen, $isSchedule, $scheduleInput, $maxPlayers, $_SESSION['user_id']);

