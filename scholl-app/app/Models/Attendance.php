<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Attendance
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getByClassDate(int $classId, string $date): array
    {
        $stmt = $this->conn->prepare(
            "SELECT student_id, status
             FROM attendance
             WHERE class_id = :class_id AND date = :date"
        );
        $stmt->execute(['class_id' => $classId, 'date' => $date]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['student_id']] = $row['status'];
        }
        return $map;
    }

    public function createOrUpdate(int $classId, int $studentId, string $date, string $status): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM attendance
             WHERE class_id = :class_id AND student_id = :student_id AND date = :date
             LIMIT 1"
        );
        $stmt->execute([
            'class_id' => $classId,
            'student_id' => $studentId,
            'date' => $date
        ]);
        $existingId = $stmt->fetchColumn();

        if ($existingId) {
            $update = $this->conn->prepare(
                "UPDATE attendance SET status = :status
                 WHERE id = :id"
            );
            return $update->execute(['status' => $status, 'id' => $existingId]);
        }

        $insert = $this->conn->prepare(
            "INSERT INTO attendance (class_id, student_id, status, date)
             VALUES (:class_id, :student_id, :status, :date)"
        );
        return $insert->execute([
            'class_id' => $classId,
            'student_id' => $studentId,
            'status' => $status,
            'date' => $date
        ]);
    }

    public function getByStudent(int $studentId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT attendance.date, attendance.status, classes.name as class_name
             FROM attendance
             INNER JOIN classes ON classes.id = attendance.class_id
             WHERE attendance.student_id = :student_id
             ORDER BY attendance.date DESC"
        );
        $stmt->execute(['student_id' => $studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
