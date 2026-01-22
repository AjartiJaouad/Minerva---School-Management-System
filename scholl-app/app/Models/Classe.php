<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Classe
{
    private $conn;
    private $table = 'classes';
    public $id;
    public $name;
    public $teatcher_id;
    public $created_at;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    // en recuprere tout les  classes avec le nom de l'enseignant
    public function getAll()
    {
        $query = "SELECT classes.*, users.name as teacher_name 
                  FROM " . $this->table . "
                  LEFT JOIN users ON classes.teacher_id = users.id
                  ORDER BY classes.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($name, $teacher_id)
    {
        $query = "INSERT INTO " . $this->table . " (name, teacher_id) VALUES (:name, :teacher_id)";
        $stmt = $this->conn->prepare($query);

        // pour la Security
        $name = htmlspecialchars(strip_tags($name));
        $teacher_id = htmlspecialchars(strip_tags($teacher_id));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':teacher_id', $teacher_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Récupérer une classe par ID
    public function getById($id)
    {
        $query = "SELECT classes.*, users.name as teacher_name 
                  FROM " . $this->table . "
                  LEFT JOIN users ON classes.teacher_id = users.id
                  WHERE classes.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les étudiants d'une classe
    public function getStudents($class_id)
    {
        $query = "SELECT u.* FROM users u
                  JOIN class_students cs ON u.id = cs.student_id
                  WHERE cs.class_id = :class_id AND u.role = 'student'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un étudiant à une classe
    public function addStudent($class_id, $student_id)
    {
        // Vérifier si l'étudiant n'est pas déjà dans la classe
        $query = "SELECT * FROM class_students WHERE class_id = :class_id AND student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; // Étudiant déjà dans la classe
        }

        $query = "INSERT INTO class_students (class_id, student_id) VALUES (:class_id, :student_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':student_id', $student_id);

        return $stmt->execute();
    }

    // Supprimer un étudiant d'une classe
    public function removeStudent($class_id, $student_id)
    {
        $query = "DELETE FROM class_students WHERE class_id = :class_id AND student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':class_id', $class_id);
        $stmt->bindParam(':student_id', $student_id);

        return $stmt->execute();
    }
}
