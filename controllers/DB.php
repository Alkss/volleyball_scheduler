<?php

namespace controllers;

use mysqli;

class DB
{
    private string $dbServerName = "213.190.6.43";
    private string $dbUsername = "u973673548_volley";
    private string $dbPassword = "4ga5IIMC9JgM9ljspkI\$d";
    private string $dbName = "u973673548_volley";
    private mysqli $conexion;

    public function __construct()
    {
        $this->conexion = $this->connect();
    }

    private function connect(): mysqli
    {
        $conexion = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbName, "3306");
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_errno);
        }
        return $conexion;
    }

    public function select(string $sqlQuery): ?array
    {
        $result = $this->conexion->query($sqlQuery);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function validateIfEmailIsAlreadyBeingUsed(string $user_email): bool
    {
        $userSelection = $this->conexion->query("SELECT * FROM `user` WHERE email='$user_email'");
        if ($userSelection->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function updateUser(int $user_id, string $user_name, string $user_email, string $user_password, $isAdmin): bool
    {
        if (empty($user_password)) {
            $update = $this->conexion->query("UPDATE `user` SET 
                  `name`='$user_name',
                  `email`='$user_email',
                  `isAdmin` = {$isAdmin}
                WHERE `id`='$user_id'");

        } else {
            $md5Password = md5($user_password);
            $update = $this->conexion->query
            ("UPDATE `user` SET
                  `name`='$user_name',
                  `email`='$user_email',
                  `isAdmin` = {$isAdmin},
                  `password`='$md5Password' 
                WHERE `id`='$user_id'");
        }

        if ($update) {
            return true;
        } else {
            return false;
        }
    }

}