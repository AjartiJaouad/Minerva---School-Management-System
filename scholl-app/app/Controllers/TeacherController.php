<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Work;

class TeacherController {
    
    public function dashboard() {
        Auth::requireTeacher();
        
        $name = Auth::getUserName();

        $workModel = new Work();
        $works = $workModel->getByTeacher((int) Auth::getUserId());
        $recentWorks = array_slice($works, 0, 3);
        $pendingWorksAll = array_values(array_filter($works, static function ($work) {
            return (int) ($work['submitted_count'] ?? 0) > 0;
        }));
        $pendingWorks = array_slice($pendingWorksAll, 0, 3);
        $workCount = count($works);
        $pendingCount = count($pendingWorksAll);
        
        require_once __DIR__ . '/../views/teacher/dashboard.php';
    }
}
?>
