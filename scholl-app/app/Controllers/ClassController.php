<?php

namespace App\Controllers;

use App\Models\Classe;

class ClassController
{

    public function index()
    {
        $classeModel = new Classe();
        $classes = $classeModel->getAll();

        require_once dirname(__DIR__) . '/views/classes/index.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $teacher_id = $_POST['teacher_id'];
            $classeModel = new Classe();
            if ($classeModel->create($name, $teacher_id)) {
                header('Location: /classes');
                exit;
            }
        }
        require_once dirname(__DIR__) . '/views/classes/create.php';
    }
}
