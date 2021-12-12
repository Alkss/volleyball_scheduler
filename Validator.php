<?php

use controllers\DB;
use JetBrains\PhpStorm\NoReturn;

require_once "controllers/DB.php";

class Validator
{
    #[NoReturn] public static function redirectToHome()
    {
        header("Location: /index.php");
        die();
    }

    public static function validateIfLoggedAndRedirect()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: /view/manage/index.php");
            die();
        }
    }

    public static function validateIfLoggedAndAskForLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            session_start();
            session_destroy();
            header("Location: /login.php");
            die();
        }
    }

    public static function validateIfLoggedAdminAndAskForLogin()
    {
        if (!isset($_SESSION['user_id']) && (!isset($_SESSION['user_isAdmin']) && $_SESSION['user_isAdmin'] != 1)) {
            session_start();
            session_destroy();
            header("Location: /login.php");
            die();
        }
    }

    public static function validateLogin(string $userEmail, string $userPassword)
    {
        $db = new DB();
        $md5Password = md5($userPassword);
        $validation = $db->select("SELECT * FROM `user` 
                                            WHERE email='{$userEmail}' AND
                                                  password='{$md5Password}'");
        if (!is_null($validation)) {
            return $validation;
        } else {
            return false;
        }
    }

    public static function checkIfCourtIsOpen($courtId)
    {
        $db = new DB();
        $validation = $db->select("
            SELECT isOpen FROM court where id='{$courtId}'
        ")['isOpen'];
        if ($validation==0){
            header("Location: /index.php");
            die();
        }
    }
}