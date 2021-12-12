<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAndAskForLogin();
$db = new DB();
$courtList = $db->getActiveCourtsByUser($_SESSION['user_id']);

$date = date("Y-m-d H:i:s");
?>
    <div class="row justify-content-center">
        <?php
        if (is_null($courtList)) {
            ?>
            <h3 class="h3 text-center">You don't have any active courts right now!</h3>
            <?php
        } else {
            ?>
            <h3 class="h3 text-center">Active courts</h3>

            <?php
            foreach ($courtList as $singleCourt) {
                $date = date_create($singleCourt['datetime'])
                ?>
                <div class="card m-3" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="card-title"><?= $singleCourt['day_name'] ?></h5>
                            </div>
                            <div class="col-5">
                                <a href="/view/manage/courts/edit.php?id=<?= $singleCourt['id'] ?>"
                                   class="btn btn-outline-light"><i class="fas fa-pen"></i> Edit</a>
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted"><?= date_format($date, "d-m-Y H:i") ?></h6>
                        </div>
                        <p href="#" class="card-text"><?= $singleCourt['isOpen'] ? "Open" : "Closed" ?></p>
                        <?php
                        if ($singleCourt['isScheduled'] && !$singleCourt['isOpen']) {
                            $scheduleDate = date_create($singleCourt['scheduleDatetime'])
                            ?>
                            <p href="#" class="card-text">Opening at: <?= date_format($scheduleDate, "d-m-Y H:i") ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
        }
        ?>
    </div>

<?php
include "../../assets/footer.php";