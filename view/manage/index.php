<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use controllers\DB;

include $_SERVER['DOCUMENT_ROOT'] . '/view/assets/header.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
Validator::validateIfLoggedAndAskForLogin();

require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";
$db = new DB();
$courts = $db->getActiveCourts();
?>
    <div class="justify-content-center text-center">
        <h1>AVAILABLE DAYS</h1>
    </div>
    <div class="row text-dark justify-content-around">

        <?php
        foreach ($courts as $singleCourt) {
            $date = date_create($singleCourt['datetime'])
            ?>
            <div class="card mb-3 p-0" style="width: 18rem;">
                <a href="/court.php?id=<?= $singleCourt['id'] ?>">
                    <img src="/assets/images/<?= $singleCourt['code'] ?>.jpg" class="card-img-top" alt="ACM Picture">
                </a>
                <div class="card-body">
                    <p class="card-datetime mb-0"><?= date_format($date, "d/m/Y - H:i") ?></p>
                    <p class="card-text">(<?= $singleCourt['max_Players'] ?> people)</p>
                    <p>
                        <a href="/view/manage/courts/edit.php?id=<?= $singleCourt['id'] ?>"
                           class="btn btn-outline-light"><i class="fas fa-pen"></i> Edit</a>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php
if (isset($_SESSION['user_isAdmin']) && $_SESSION['user_isAdmin'] == 1) {
    $historyCourts = $db->getHistoryCourts();
    ?>
    <div class="justify-content-center text-center">
        <h1>HISTORY</h1>
    </div>
    <div class="row justify-content-center">
        <?php
        foreach ($historyCourts as $singleHistory) {
            ?>
            <div class="card m-3 col-sm-12" style="width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title"><?= $singleHistory['day_name'] ?> (<?= $singleHistory['id'] ?>)</h5>
                        </div>
                        <div class="col-4">
                            <a href="/view/manage/courts/edit.php?id=<?= $singleHistory['id'] ?>"
                               class="btn btn-outline-light">View</a>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted"><?= date_format($date, "d-m-Y H:i") ?></h6>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/view/assets/footer.php';
