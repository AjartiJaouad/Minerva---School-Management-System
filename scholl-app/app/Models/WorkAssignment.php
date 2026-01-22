<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class WorkAssignment
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function assignMany(int $workId, array $studentIds): void
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO work_assignments (work_id, student_id)
             VALUES (:work_id, :student_id)"
        );

        foreach ($studentIds as $studentId) {
            $studentId = (int) $studentId;
            if ($studentId <= 0) {
                continue;
            }
            if ($this->isAssigned($workId, $studentId)) {
                continue;
            }
            $stmt->execute([
                'work_id' => $workId,
                'student_id' => $studentId
            ]);
        }
    }

    public function isAssigned(int $workId, int $studentId): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM work_assignments
             WHERE work_id = :work_id AND student_id = :student_id
             LIMIT 1"
        );
        $stmt->execute(['work_id' => $workId, 'student_id' => $studentId]);
        return (bool) $stmt->fetchColumn();
    }

    public function getAssignedStudents(int $workId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT users.id, users.name, users.email
             FROM work_assignments
             INNER JOIN users ON users.id = work_assignments.student_id
             WHERE work_assignments.work_id = :work_id
             ORDER BY users.name ASC"
        );
        $stmt->execute(['work_id' => $workId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignedWorksByStudent(int $studentId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT works.*, classes.name as class_name,
                    CASE WHEN submissions.id IS NULL THEN 'pending' ELSE 'submitted' END as status,
                    submissions.id as submission_id
             FROM work_assignments
             INNER JOIN works ON works.id = work_assignments.work_id
             INNER JOIN classes ON classes.id = works.class_id
             LEFT JOIN submissions ON submissions.work_id = works.id
                                  AND submissions.student_id = :student_id
             WHERE work_assignments.student_id = :student_id
             ORDER BY works.created_at DESC"
        );
        $stmt->execute(['student_id' => $studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
