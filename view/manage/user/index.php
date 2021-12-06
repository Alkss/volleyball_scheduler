<?php
include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
Validator::validateIfLoggedAndAskForLogin();
?>


<?php
include "../../assets/footer.php";