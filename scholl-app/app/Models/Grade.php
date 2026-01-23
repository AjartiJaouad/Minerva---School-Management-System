<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Grade
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getBySubmissionId(int $submissionId): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM grades WHERE submission_id = :submission_id LIMIT 1"
        );
        $stmt->execute(['submission_id' => $submissionId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function createOrUpdate(int $submissionId, float $grade, ?string $comment): bool
    {
        $existing = $this->getBySubmissionId($submissionId);
        if ($existing) {
            $stmt = $this->conn->prepare(
                "UPDATE grades SET grade = :grade, comment = :comment, graded_at = NOW()
                 WHERE id = :id"
            );
            return $stmt->execute([
                'grade' => $grade,
                'comment' => $comment,
                'id' => $existing['id']
            ]);
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO grades (submission_id, grade, comment)
             VALUES (:submission_id, :grade, :comment)"
        );
        return $stmt->execute([
            'submission_id' => $submissionId,
            'grade' => $grade,
            'comment' => $comment
        ]);
    }

    public function getByStudent(int $studentId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT works.title, grades.grade, grades.comment, grades.graded_at
             FROM submissions
             INNER JOIN works ON works.id = submissions.work_id
             LEFT JOIN grades ON grades.submission_id = submissions.id
             WHERE submissions.student_id = :student_id
             ORDER BY submissions.submitted_at DESC"
        );
        $stmt->execute(['student_id' => $studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
