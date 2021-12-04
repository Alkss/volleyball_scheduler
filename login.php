<?php
include "view/assets/header.php";
require_once 'Validator.php';
Validator::validateIfLoggedAndRedirect();
?>
    <div class="alert alert-danger text-center" role="alert" style="display: none" id="error-message">
        Email or Password incorrect
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" id="submitBtn" class="btn btn-outline-light">Submit</button>
        </div>
    </div>
    <script src="js/login.js"></script>
<?php
include "view/assets/footer.php";
