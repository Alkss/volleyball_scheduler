<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAndAskForLogin();
$db = new DB();
$availableDays = $db->getAvailableCourtDaysByUser($_SESSION['user_id']);
?>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="day_week">Day of the Week</label>
                    <select class="form-select" aria-label="Day of the Week" id="day_week" name="day_week">
                        <option selected disabled="disabled" hidden="hidden">SELECT THE DAY OF WEEK</option>

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
                    <input type="number" min="12" max="16" name="max_players" id="max_players" class="form-control">
                </div>
            </div>


            <div class="mb-3">
                <label for="dateInput">Date and Time</label>
                <input type="datetime-local" name="dateInput" id="dateInput" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="scheduleInput">Time to open the List</label>
                        <input type="datetime-local" name="scheduleInput" id="scheduleInput" class="form-control"
                               disabled="disabled">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="scheduleTrigger" name="scheduleTrigger">
                        <label class="form-check-label" for="scheduleTrigger">Open the list on schedule? <span
                                    style="color: darkred">(BETA)</span></label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="isOpen" name="isOpen">
                        <label class="form-check-label" for="isOpen">Is the list open?</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-light" id="create"><i class="fas fa-plus"></i> Create</button>

        </div>
    </div>

<script type="text/javascript" src="/js/court/create.js"></script>
<?php
include "../../assets/footer.php";