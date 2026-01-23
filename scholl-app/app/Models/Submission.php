<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Submission
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getByStudentWork(int $workId, int $studentId): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM submissions
             WHERE work_id = :work_id AND student_id = :student_id
             LIMIT 1"
        );
        $stmt->execute(['work_id' => $workId, 'student_id' => $studentId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function createOrUpdate(int $workId, int $studentId, ?string $content, ?string $filePath): bool
    {
        $existing = $this->getByStudentWork($workId, $studentId);
        if ($existing) {
            $stmt = $this->conn->prepare(
                "UPDATE submissions
                 SET content = :content, file_path = :file_path, submitted_at = NOW()
                 WHERE id = :id"
            );
            return $stmt->execute([
                'content' => $content,
                'file_path' => $filePath,
                'id' => $existing['id']
            ]);
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO submissions (work_id, student_id, content, file_path)
             VALUES (:work_id, :student_id, :content, :file_path)"
        );
        return $stmt->execute([
            'work_id' => $workId,
            'student_id' => $studentId,
            'content' => $content,
            'file_path' => $filePath
        ]);
    }

    public function getByWork(int $workId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT submissions.*, users.name, users.email
             FROM submissions
             INNER JOIN users ON users.id = submissions.student_id
             WHERE submissions.work_id = :work_id
             ORDER BY submissions.submitted_at DESC"
        );
        $stmt->execute(['work_id' => $workId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
