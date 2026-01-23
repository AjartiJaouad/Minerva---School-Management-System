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
        $this->conn = Database::getInstance()->getConnection();
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

    public function getAllByTeacher(int $teacherId): array
    {
        $query = "SELECT classes.*, users.name as teacher_name,
                         COUNT(class_students.id) as student_count
                  FROM " . $this->table . "
                  LEFT JOIN users ON classes.teacher_id = users.id
                  LEFT JOIN class_students ON class_students.class_id = classes.id
                  WHERE classes.teacher_id = :teacher_id
                  GROUP BY classes.id
                  ORDER BY classes.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $query = "SELECT classes.*, users.name as teacher_name 
                  FROM " . $this->table . "
                  LEFT JOIN users ON classes.teacher_id = users.id
                  WHERE classes.id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function getByStudent(int $studentId): array
    {
        $query = "SELECT classes.*
                  FROM classes
                  INNER JOIN class_students ON class_students.class_id = classes.id
                  WHERE class_students.student_id = :student_id
                  ORDER BY classes.name ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['student_id' => $studentId]);
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
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
