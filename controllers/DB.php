<?php
namespace controllers;

use mysqli;
use mysqli_result;

class DB
{
    private $dbServerName = "213.190.6.43";
    private $dbUsername = "u973673548_volley";
    private $dbPassword = "4ga5IIMC9JgM9ljspkI\$d";
    private $dbName = "u973673548_volley";
    private $conexion;

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
}