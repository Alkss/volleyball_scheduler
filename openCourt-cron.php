<?php
use controllers\DB;

require_once "controllers/DB.php";

$db = new DB();

$courtsToOpen = $db->getCourtsToOpen();
foreach ($courtsToOpen as $singleCourt) {
    if ($db->openCourtById($singleCourt['id'])) {
        printf("Success opening court.");
    } else {
        printf("Failed to open court using schedule");
    }
}
