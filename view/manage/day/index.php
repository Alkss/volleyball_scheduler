<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAdminAndAskForLogin();
$db = new DB();
$allDays = $db->getAllDays();

$availableDays = $db->getAvailableDays();
$allUsers = $db->getAllUsers();

?>
    <div class="row justify-content-center">
        <h4 class="text-center">Existent Days</h4>
        <?php
        foreach ($allDays as $singleDay) {
            ?>
            <input type="hidden" id="day_id-<?= $singleDay['id'] ?>" value="<?= $singleDay['id'] ?>">
            <div class="mb-3 col-md-5">
                <label for="day_week">Day of the Week</label>
                <select class="form-select" aria-label="Day of the Week" id="day_week-<?= $singleDay['id'] ?>"
                        name="day_week-<?= $singleDay['id'] ?>">
                    <option selected hidden="hidden" value="<?= $singleDay['day_id'] ?>">
                        <?= $singleDay['day_name'] ?>(<?= $singleDay['code'] ?>)
                    </option>
                    <?php
                    foreach ($availableDays as $day) {
                        ?>
                        <option value="<?= $day['id'] ?>>"><?= $day['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3 col-md-5">
                <label for="owner">Owner</label>
                <select class="form-select" aria-label="Owner of the Court" id="owner-<?= $singleDay['id'] ?>"
                        name="owner-<?= $singleDay['id'] ?>">
                    <option selected hidden="hidden" value="<?= $singleDay['user_id'] ?>">
                        <?= $singleDay['name'] ?>
                    </option>
                    <?php
                    foreach ($allUsers as $user) {
                        ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 pt-4 col-md-1 text-center">
                <button type="button" id="court-<?= $singleDay['id'] ?>" class="court-btn btn btn-outline-light"
                        data-id="<?= $singleDay['id'] ?>">
                    Update
                </button>
            </div>
            <?php
        }
        ?>
        <div class="row col-md-10 text-center">
            <a href="/view/manage/day/create.php" class="btn btn-outline-success">
                <i class="fas fa-plus-circle"></i> Create a new Day</a>
        </div>
    </div>
    <script src="/js/day/edit.js" type="text/javascript"></script>

<?php
include "../../assets/footer.php";