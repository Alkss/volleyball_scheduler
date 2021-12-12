<?php

use controllers\DB;

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";
$courtId = $_POST['court_id'];
$db = new DB();

$db->insertPlayer($_POST['player_name'], $courtId);
$playerId = $db->getLastInsertedId();
$db->insertPlayerIntoCourt($courtId, $playerId);