<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Submission {
    private $db;
    private $table = 'submissions';

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Créer une soumission
    public function create($work_id, $student_id, $content = null, $file_path = null) {
        $sql = "INSERT INTO " . $this->table . " (work_id, student_id, content, file_path) 
                VALUES (:work_id, :student_id, :content, :file_path)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':work_id' => $work_id,
            ':student_id' => $student_id,
            ':content' => $content,
            ':file_path' => $file_path
        ]);
    }

    // Récupérer la soumission d'un étudiant pour un devoir
    public function getStudentSubmission($work_id, $student_id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE work_id = :work_id AND student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':work_id' => $work_id,
            ':student_id' => $student_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour une soumission
    public function update($id, $content = null, $file_path = null) {
        $sql = "UPDATE " . $this->table . " SET content = :content, file_path = :file_path, submitted_at = NOW() WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':content' => $content,
            ':file_path' => $file_path
        ]);
    }

    // Récupérer toutes les soumissions pour un devoir
    public function getWorkSubmissions($work_id) {
        $sql = "SELECT s.*, u.name as student_name FROM " . $this->table . " s
                JOIN users u ON s.student_id = u.id
                WHERE s.work_id = :work_id
                ORDER BY s.submitted_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':work_id' => $work_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
