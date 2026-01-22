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
      
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name' => $data['name'], 
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role']
        ]);
    }

    // Récupérer tous les étudiants
    public function getAllStudents() {
        $sql = "SELECT * FROM users WHERE role = 'student' ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les étudiants non affectés à une classe
    public function getUnassignedStudents($class_id) {
        $sql = "SELECT DISTINCT u.* FROM users u
                WHERE u.role = 'student' 
                AND u.id NOT IN (
                    SELECT student_id FROM class_students WHERE class_id = :class_id
                )
                ORDER BY u.name ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':class_id' => $class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}