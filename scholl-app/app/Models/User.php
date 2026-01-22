<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($name, $email, $password, $role)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)"
        );

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'role' => $role
        ]);
    }

    public function createWithId($name, $email, $password, $role): ?int
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)"
        );

        $ok = $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'role' => $role
        ]);

        if (!$ok) {
            return null;
        }

        return (int) $this->db->lastInsertId();
    }
}
