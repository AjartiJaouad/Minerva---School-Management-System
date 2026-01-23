<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {

    private static ?Database $instance = null; // Singleton instance
    private PDO $connection;                    // PDO connection

    // DB config (defaults, overridden by config/db.php if present)
    private string $host = 'localhost';
    private string $port = '3306';
    private string $dbname = 'school_app';
    private string $username = 'root';
    private string $password = '';

    // Private constructor prevents direct creation
    private function __construct() {
        $configPath = __DIR__ . '/../../config/db.php';
        if (file_exists($configPath)) {
            require_once $configPath;
            if (defined('DB_HOST')) {
                $this->host = DB_HOST;
            }
            if (defined('DB_PORT')) {
                $this->port = DB_PORT;
            }
            if (defined('DB_NAME')) {
                $this->dbname = DB_NAME;
            }
            if (defined('DB_USER')) {
                $this->username = DB_USER;
            }
            if (defined('DB_PASS')) {
                $this->password = DB_PASS;
            }
        }

        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    // Get singleton instance
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get PDO connection
    public function getConnection(): PDO {
        return $this->connection;
    }

    // Prevent cloning and unserializing
    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
}
