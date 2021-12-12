<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAdminAndAskForLogin();
$db = new DB();
$allDays = $db->getAvailableDays();
$allUsers = $db->getAllUsers();
?>
    <div class="row justify-content-center">
        <div class="mb-3 col-md-6">
            <label for="day_week">Day of the Week</label>
            <select class="form-select" aria-label="Day of the Week" id="day_week" name="day_week">
                <option selected disabled="disabled" hidden="hidden">SELECT THE DAY OF WEEK</option>

                <?php
                foreach ($allDays as $day) {
                    ?>
                    <option value="<?= $day['id'] ?>>"><?= $day['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="owner">Owner</label>
            <select class="form-select" aria-label="Owner of the Court" id="owner" name="owner">
                <option selected disabled="disabled" hidden="hidden">SELECT THE OWNER OF THE COURT</option>
                <?php
                foreach ($allUsers as $user) {
                    ?>
                    <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-light" id="create"><i class="fas fa-pencil-alt"></i> Edit</button>
    </div>
    <script src="/js/day/create.js"></script>
<?php
include "../../assets/footer.php";