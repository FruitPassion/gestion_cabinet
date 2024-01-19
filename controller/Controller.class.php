<?php

class Controller
{
    public string $error = "";
    private ?PDO $pdo = null;
    private $stmt = null;

    private array $erreurs = [];

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        if (isset($_SESSION["erreurs"])){
            $this->erreurs = $_SESSION["erreurs"];
            unset($_SESSION["erreurs"]);
        }
    }

    public function __destruct()
    {
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    protected function selectFirst($sql, $data = null): false|array
    {
        $this->insertUpdateDelete($sql, $data);
        return $this->stmt->fetch();
    }

    protected function selectAll($sql, $data = null): false|array
    {
        $this->insertUpdateDelete($sql, $data);
        return $this->stmt->fetchAll();
    }

    protected function insertUpdateDelete($sql, $data = null): void
    {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($data);
    }

    protected function resetDataBase(): void {
        require "sql/reset.sql";
        $query = file_get_contents("sql/reset.sql");
        $this->insertUpdateDelete($query);
    }

    protected function redirect($url, $permanent = false): void
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    protected function getErreurs(): array {
        return $this->erreurs;
    }
}

// (D) DATABASE SETTINGS - CHANGE TO YOUR OWN!
const DB_HOST = "localhost";
const DB_NAME = "db_gestion_cabinet";
const DB_CHARSET = "utf8mb4";
const DB_USER = "local_user";
const DB_PASSWORD = "password";
