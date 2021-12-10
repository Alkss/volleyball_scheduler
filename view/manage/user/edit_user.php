<?php

use controllers\DB;

include "../../assets/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Validator.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/DB.php";

Validator::validateIfLoggedAdminAndAskForLogin();
$db = new DB();
$user = $db->getUserById($_GET['id']);

?>
    <div class="alert alert-danger text-center" role="alert" style="display: none" id="password-message">
        Passwords don't match
    </div>
    <div class="alert alert-danger text-center" role="alert" style="display: none" id="email-message">
        Email is already being used by another user
    </div>
    <div class="alert alert-success text-center" role="alert" style="display: none" id="success-message">
        User updated successfully
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-4">
            <div class="mb-3">
                <label for="user_name" class="form-label">Name</label>
                <input type="email" class="form-control" name="user_name" id="user_name"
                       value="<?= $user['name'] ?? "" ?>">
            </div>

            <div class="mb-3">
                <input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?? null ?>">
                <input type="hidden" name="self_edit" id="self_edit" value="false">
                <label for="user_email" class="form-label">Email address</label>
                <input type="email" id="user_email" class="form-control" name="user_email" aria-describedby="emailHelp"
                       value="<?= $user['email'] ?? "" ?>">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="user_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="user_password" name="user_password">
            </div>

            <div class="mb-3">
                <label for="user_password_confirm" class="form-label">New Password Confirmation</label>
                <input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm">
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="isAdmin"
                           name="isAdmin">
                    <label class="form-check-label" for="isAdmin">Administrator</label>
                </div>
            </div>
            <button type="submit" class="btn btn-light" id="edit"><i class="fas fa-pencil-alt"></i> Edit</button>
        </div>
        <div class="col-sm-12 col-md-8">
            <!--add court/day-->
            <p class="text-center">Court Days</p>
            <div class="border rounded">
                content
            </div>
        </div>
    </div>



    <script type="text/javascript" src="../../../js/user/edit.js"></script>

<?php
include "../../assets/footer.php";