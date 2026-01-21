<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Classe
{
    private $conn;
    private $table = 'classes';
    public $id;
    public $name;
    public $teatcher_id;
    public $created_at;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }
   // en recuprere tout les  classes avec le nom de l'enseignant
   public function getAll() {
        $query = "SELECT classes.*, users.username as teacher_name 
                  FROM " . $this->table . "
                  LEFT JOIN users ON classes.teacher_id = users.id
                  ORDER BY classes.created_at DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
