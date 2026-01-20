<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    
    private $connection;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';     
    private $dbname = 'school_app'; 

    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            
            // On veut que SQL nous crie dessus s'il y a une erreur (Exception)
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Erreur de connexion a BDD : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
    
    private function __clone() {}
}