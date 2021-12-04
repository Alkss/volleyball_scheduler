<?php
include "../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
Validator::validateIfLoggedAndAskForLogin();
?>
    <div class="row text-dark justify-content-around">
        <div class="card mb-3 p-0" style="width: 18rem;">
            <a href="/court.php">
                <img src="/assets/images/acm.jpg" class="card-img-top" alt="ACM Picture">
            </a>
            <div class="card-body text-center">
                <h5 class="border border-light p-2">Manage Users</h5>
            </div>
        </div>
        <div class="card mb-3 p-0" style="width: 18rem;">
            <a href="/court.php">
                <img src="/assets/images/acm.jpg" class="card-img-top" alt="ACM Picture">
            </a>
            <div class="card-body text-center">
                <h5 class="border border-light p-2">Manage Courts</h5>
            </div>
        </div>
        <div class="card mb-3 p-0" style="width: 18rem;">
            <a href="/court.php">
                <img src="/assets/images/acm.jpg" class="card-img-top" alt="ACM Picture">
            </a>
            <div class="card-body text-center">
                <h5 class="border border-light p-2">Manage Days</h5>
            </div>
        </div>

    </div>
<?php
include "../assets/footer.php";
