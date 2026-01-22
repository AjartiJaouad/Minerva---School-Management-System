<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    public $conn;

    public function getConnection() {
        $this->conn = null;

        
        $config = require __DIR__ . '/../../config/db.php';

        try {
            $dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8";
            
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        return $this->conn;
    }
}