<?php
namespace App\Controllers;

use App\Core\Auth;

class TeacherController {
    
    public function dashboard() {
        Auth::requireTeacher();
        
        $name = Auth::getUserName();
        
        require_once __DIR__ . '/../views/teacher/dashboard.php';
    }
}
?>