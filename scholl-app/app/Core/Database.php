<?php
namespace App\Core; // 👈 ضروري هاد السطر يكون هو اللول

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $dbname = 'school_app';
    private $username = 'root';
    private $password = '';

    public function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die(" Erreur de connexion : " . $e->getMessage());
        }
    }
}