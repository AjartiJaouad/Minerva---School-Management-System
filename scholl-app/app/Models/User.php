<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($data) {
      
        $sql = "INSERT INTO users (nom, email, password, role) VALUES (:nom, :email, :password, :role)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':nom' => $data['name'], 
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role']
        ]);
    }
}