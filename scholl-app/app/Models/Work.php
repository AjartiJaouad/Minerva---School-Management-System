<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Work {
    private $db;
    private $table = 'works';

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Récupérer tous les devoirs d'une classe
    public function getWorksByClass($class_id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE class_id = :class_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':class_id' => $class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un devoir par ID
    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un devoir
    public function create($class_id, $title, $description, $file_path = null) {
        $sql = "INSERT INTO " . $this->table . " (class_id, title, description, file_path) 
                VALUES (:class_id, :title, :description, :file_path)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':class_id' => $class_id,
            ':title' => htmlspecialchars($title),
            ':description' => htmlspecialchars($description),
            ':file_path' => $file_path
        ]);
    }

    // Supprimer un devoir
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Récupérer les devoirs pour un étudiant (par ses classes)
    public function getStudentWorks($student_id) {
        $sql = "SELECT DISTINCT w.* FROM works w
                JOIN classes c ON w.class_id = c.id
                JOIN class_students cs ON c.id = cs.class_id
                WHERE cs.student_id = :student_id
                ORDER BY w.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les devoirs avec les soumissions d'un étudiant
    public function getStudentWorksWithSubmissions($student_id) {
        $sql = "SELECT DISTINCT w.*, s.id as submission_id, s.content as submission_content, 
                s.file_path as submission_file, s.submitted_at
                FROM works w
                JOIN classes c ON w.class_id = c.id
                JOIN class_students cs ON c.id = cs.class_id
                LEFT JOIN submissions s ON w.id = s.work_id AND s.student_id = cs.student_id
                WHERE cs.student_id = :student_id
                ORDER BY w.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
