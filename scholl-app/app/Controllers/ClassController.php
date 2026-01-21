<?php
namespace App\Controllers;

use App\Models\Classe;

class ClassController {
    
    public function index() {
        $classeModel = new Classe();
        $classes = $classeModel->getAll();

        require_once dirname(__DIR__) . '/views/classes/index.php';
    }

}