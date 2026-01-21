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
   
}
