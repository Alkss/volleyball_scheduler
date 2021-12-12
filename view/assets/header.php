<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="/resources/bootstrap.min.js" type="text/javascript"></script> <!--Bootstrap js-->
    <link rel="stylesheet" href="/resources/bootstrap.min.css" type="text/css"/> <!--Bootstrap CSS-->
    <link rel="stylesheet" href="/resources/fontawesome/css/all.min.css" type="text/css"/> <!--Font Awesome-->
    <link rel="stylesheet" href="/resources/style.css" type="text/css"/> <!--Custom CSS-->
    <script src="/resources/jquery.min.js" type="text/javascript"></script> <!--Bootstrap Jquery-->

    <script src="/js/navbar.js" type="text/javascript"></script> <!--Navbar jquery-->


    <title>Volley Ball Scheduler</title>
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #30363c !important">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="../../index.php">
            <img src="https://upload.net-empregos.com/uploads/ef9a144fc97e42d295d88255027f0f86/logo-net-empregos.jpg"
                 alt="" width="30" height="24" class="d-inline-block align-text-top">
            VolleyBall Scheduler
        </a>
        <?php
        if (isset($_SESSION['user_id'])) {
            ?>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                           role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-space-shuttle"></i> My Space
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/view/manage/index.php">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>

                            <li><a class="dropdown-item" href="/view/manage/user/edit_self.php">
                                    <i class="fas fa-user-edit"></i> Edit Profile
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if (isset($_SESSION['user_isAdmin']) && $_SESSION['user_isAdmin'] == 1) {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-users"></i> Users
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="/view/manage/user/index.php">
                                        <i class="fas fa-users-cog"></i> Manage Users
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/view/manage/user/create.php">
                                        <i class="fas fa-user-plus"></i> Create User
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-calendar-alt"></i> Days
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="/view/manage/day/index.php">
                                        <i class="fas fa-calendar-week"></i> Manage Days
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/view/manage/day/create.php">
                                        <i class="fas fa-calendar-plus"></i> Create Days
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                           role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-list-alt"></i> Courts
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="/view/manage/courts/index.php">
                                    <i class="fas fa-tasks"></i> Manage Courts
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/view/manage/courts/create.php">
                                    <i class="fas fa-folder-plus"></i> Create Court
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-light" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</nav>
<div class="container mt-5" id="main">