<?php

use controllers\DB;

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";

Validator::checkIfCourtIsOpen($_GET['id']);

include 'view/assets/header.php';

$db = new DB();
$courtInfo = $db->getCourtInfo($_GET['id']);
$date = date_create($courtInfo['datetime']);
$playerList = $db->getPlayerListByCourtId($_GET['id']);


$confirmedList = [];
$waitingList = [];

foreach ($playerList as $singlePlayer) {
    if ($singlePlayer['isWaitingList'] == 0) {
        $confirmedList[] = $singlePlayer['name'];
    } else {
        $waitingList[] = $singlePlayer['name'];
    }
}

?>
    <input type="hidden" value="<?= $_GET['id'] ?>" id="court_id">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8 col-sm-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Your name here" aria-label="Your name here"
                       aria-describedby="button-addon2" id="player_name">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mb-5">
        <h1><?= date_format($date, "d/m/Y - H:i") ?></h1>
        <h3><?= $courtInfo['name'] ?></h3>
    </div>

    <div class="row ms-md-5 me-md-5 ps-md-5 pe-md-5 justify-content-center">
        <div class="row col-md-6">
            <h1 class="h2 bg-success text-white width-confirmed">Confirmed</h1>
            <div class="row justify-content-sm-center justify-content-md-end">
                <div class="col-sm-12 border-2 border-success border-end border-top rounded-end me-md-1 border-md">
                    <?php
                    foreach ($confirmedList as $key=>$player) {
                        ?>
                        <div class="col-12 text-center text-md-end fs-5">
                            <?= $player ?>
                            <span class="badge rounded-pill bg-black floater-left">
                                <?=$key +1?>
                                <span class="visually-hidden">player position</span>
                            </span>
                            <i class="fas fa-volleyball-ball ms-2 floater-right"></i>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row col-md-6 mt-5 mt-md-0 h-100">
            <h1 class="h2 bg-secondary text-white width-wl">Waiting List</h1>
            <div class="row justify-content-sm-center justify-content-md-start">
                <div class="col-sm-12 border-2 border-light border-start border-top rounded-start ms-md-1 border-md">
                    <?php
                    foreach ($waitingList as $player) {
                        ?>
                        <div class="col-12 text-center text-md-start">
                            <i class="fas fa-chair"></i> <?= $player ?></div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="js/court.js" type="text/javascript"></script>
<?php
include "view/assets/footer.php";
?>