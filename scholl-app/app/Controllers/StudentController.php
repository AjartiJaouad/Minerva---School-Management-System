<?php
namespace App\Controllers;

use App\Core\Auth;

class StudentController {
    
    public function dashboard() {
        Auth::requireStudent();
        
        $name = Auth::getUserName();
        
        require_once __DIR__ . '/../views/student/dashboard.php';
    }
}
?>