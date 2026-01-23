<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class ClassStudent
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function isAssigned(int $classId, int $studentId): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM class_students WHERE class_id = :class_id AND student_id = :student_id LIMIT 1"
        );
        $stmt->execute(['class_id' => $classId, 'student_id' => $studentId]);
        return (bool) $stmt->fetchColumn();
    }

    public function assign(int $classId, int $studentId): bool
    {
        if ($this->isAssigned($classId, $studentId)) {
            return true;
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO class_students (class_id, student_id) VALUES (:class_id, :student_id)"
        );
        return $stmt->execute(['class_id' => $classId, 'student_id' => $studentId]);
    }

    public function remove(int $classId, int $studentId): bool
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM class_students WHERE class_id = :class_id AND student_id = :student_id"
        );
        return $stmt->execute(['class_id' => $classId, 'student_id' => $studentId]);
    }

    public function getStudentsByClass(int $classId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT users.id, users.name, users.email
             FROM class_students
             INNER jOIN users ON users.id = class_students.student_id
             WHERE class_students.class_id = :class_id
             ORDER BY users.name ASC"
        );
        $stmt->execute(['class_id' => $classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableStudents(int $classId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT users.id, users.name, users.email
             FROM users
             WHERE users.role = 'student'
             AND users.id NOT IN (
                 SELECT student_id FROM class_students WHERE class_id = :class_id
             )
             ORDER BY users.name ASC"
        );
        $stmt->execute(['class_id' => $classId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
