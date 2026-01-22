<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Work
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(int $classId, string $title, string $description, ?string $filePath): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO works (class_id, title, description, file_path)
             VALUES (:class_id, :title, :description, :file_path)"
        );

        return $stmt->execute([
            'class_id' => $classId,
            'title' => $title,
            'description' => $description,
            'file_path' => $filePath
        ]);
    }

    public function getByTeacher(int $teacherId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT works.*, classes.name as class_name,
                    COUNT(DISTINCT work_assignments.id) as assigned_count,
                    COUNT(DISTINCT submissions.id) as submitted_count
             FROM works
             INNER JOIN classes ON classes.id = works.class_id
             LEFT JOIN work_assignments ON work_assignments.work_id = works.id
             LEFT JOIN submissions ON submissions.work_id = works.id
             WHERE classes.teacher_id = :teacher_id
             GROUP BY works.id
             ORDER BY works.created_at DESC"
        );
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $workId): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT works.*, classes.name as class_name, classes.teacher_id
             FROM works
             INNER JOIN classes ON classes.id = works.class_id
             WHERE works.id = :id
             LIMIT 1"
        );
        $stmt->execute(['id' => $workId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
