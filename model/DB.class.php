<?php

class DB
{
    public string $error = "";
    private ?PDO $pdo = null;
    private $stmt = null;

    function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    function __destruct()
    {
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    function select($sql, $data = null): false|array
    {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($data);
        return $this->stmt->fetchAll();
    }
}

// (D) DATABASE SETTINGS - CHANGE TO YOUR OWN!
const DB_HOST = "localhost";
const DB_NAME = "db_gestion_cabinet";
const DB_CHARSET = "utf8mb4";
const DB_USER = "local_user";
const DB_PASSWORD = "password";
