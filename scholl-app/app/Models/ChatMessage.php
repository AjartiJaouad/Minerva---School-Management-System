<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class ChatMessage
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getByClass(int $classId, int $limit = 50): array
    {
        $stmt = $this->conn->prepare(
            "SELECT chat_messages.*, users.name
             FROM chat_messages
             INNER JOIN users ON users.id = chat_messages.user_id
             WHERE chat_messages.class_id = :class_id
             ORDER BY chat_messages.created_at DESC
             LIMIT {$limit}"
        );
        $stmt->execute(['class_id' => $classId]);
        return array_reverse($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function create(int $classId, int $userId, string $message): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO chat_messages (class_id, user_id, message)
             VALUES (:class_id, :user_id, :message)"
        );
        return $stmt->execute([
            'class_id' => $classId,
            'user_id' => $userId,
            'message' => $message
        ]);
    }
}
