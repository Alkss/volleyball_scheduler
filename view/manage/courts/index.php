<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAndAskForLogin();
$db = new DB();
?>


<?php
include "../../assets/footer.php";