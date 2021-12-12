<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAndAskForLogin();
$db = new DB();
$availableDays = $db->getAvailableCourtDaysByUser($_SESSION['user_id']);
$courtInfo = $db->getCourtInfo($_GET['id']);

$date = date_create($courtInfo['datetime']);
$dateScheduled = date_create($courtInfo['scheduleDatetime']);

$playerList = $db->getPlayerListByCourtId($_GET['id']);

$confirmedList = [];
$waitingList = [];


foreach ($playerList as $singlePlayer) {
    if ($singlePlayer['isWaitingList'] == 0) {
        $confirmedList[] = [
            "id" => $singlePlayer['player_id'],
            "name" => $singlePlayer['name']
        ];
    } else {
        $waitingList[] = [
            "id" => $singlePlayer['player_id'],
            "name" => $singlePlayer['name']
        ];
    }
}

?>
    <input type="hidden" value="<?= $_GET['id'] ?>" id="court_id">
    <input type="hidden" value="<?= $courtInfo['owner'] ?>" id="owner">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="day_week">Day of the Week</label>
                    <select class="form-select" aria-label="Day of the Week" id="day_week" name="day_week">
                        <option selected hidden="hidden"
                                value="<?= $courtInfo['day_id'] ?>">
                            <?= $courtInfo['name'] ?> (<?= $courtInfo['code'] ?>)
                        </option>
                        <?php
                        foreach ($availableDays as $day) {
                            ?>
                            <option value="<?= $day['id'] ?>"><?= $day['name'] ?> (<?= $day['code'] ?>)</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="max_players">Max Amount of Players</label>
                    <input type="number" min="12" max="16" name="max_players" id="max_players" class="form-control"
                           value="<?= $courtInfo['max_Players'] ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="dateInput">Date and Time</label>
                <input type="datetime-local" name="dateInput" id="dateInput" class="form-control"
                       value="<?= date_format($date, "Y-m-d") ?>T<?= date_format($date, "H:i") ?>">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="scheduleInput">Time to open the List</label>
                        <input type="datetime-local" name="scheduleInput" id="scheduleInput" class="form-control"
                            <?= $courtInfo['isScheduled'] == "0" ? "disabled='disabled'" : "" ?>
                               value="<?= date_format($dateScheduled, "Y-m-d") ?>T<?= date_format($dateScheduled, "H:i") ?>">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="scheduleTrigger"
                               name="scheduleTrigger" <?= $courtInfo['isScheduled'] == "1" ? "checked='checked'" : "" ?> >
                        <label class="form-check-label" for="scheduleTrigger">Open the list on schedule? <span
                                    style="color: darkred">(BETA)</span></label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isOpen"
                               name="isOpen" <?= $courtInfo['isOpen'] == "1" ? "checked='checked'" : "" ?>>
                        <label class="form-check-label" for="isOpen">Is the list open?</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-light" id="edit"><i class="fas fa-pencil-alt"></i> Edit</button>
        </div>
    </div>

    <div class="mt-5 row ms-md-5 me-md-5 ps-md-5 pe-md-5 justify-content-center">
        <div class="row col-md-6">
            <h1 class="h2 bg-success text-white width-confirmed">Confirmed</h1>
            <div class="row justify-content-sm-center justify-content-md-end">
                <div class="col-sm-12 border-2 border-success border-end border-top rounded-end me-md-1 border-md">
                    <?php
                    foreach ($confirmedList as $player) {
                        ?>
                        <div class="col-12 text-center text-md-end">
                            <?= $player['name'] ?> <i class="fas fa-volleyball-ball"></i>
                            <button class="rmv-btn ms-2 btn btn-outline-danger me-2" data-id="<?= $player['id'] ?>"><i
                                        class="fas fa-arrow-right"></i></button>
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
                            <button class="add-btn me-2 ms-2 btn btn-outline-success" data-id="<?= $player['id'] ?>">
                                <i class="fas fa-arrow-left"></i></button>
                            <i class="fas fa-chair"></i> <?= $player['name'] ?></div>

                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/js/court/edit.js"></script>
<?php
include "../../assets/footer.php";