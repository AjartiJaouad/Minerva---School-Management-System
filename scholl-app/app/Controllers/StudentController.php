<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Grade;
use App\Models\WorkAssignment;

class StudentController {
    
    public function dashboard() {
        Auth::requireStudent();
        
        $name = Auth::getUserName();

        $assignmentModel = new WorkAssignment();
        $works = $assignmentModel->getAssignedWorksByStudent((int) Auth::getUserId());
        $recentWorks = array_slice($works, 0, 3);
        $workCount = count($works);
        $pendingWorkCount = 0;
        foreach ($works as $work) {
            if (($work['status'] ?? '') === 'pending') {
                $pendingWorkCount++;
            }
        }

        $gradeModel = new Grade();
        $grades = $gradeModel->getByStudent((int) Auth::getUserId());
        $recentGrades = array_slice($grades, 0, 3);
        $gradeSum = 0.0;
        $gradeCount = 0;
        foreach ($grades as $grade) {
            if ($grade['grade'] !== null && $grade['grade'] !== '') {
                $gradeSum += (float) $grade['grade'];
                $gradeCount++;
            }
        }
        $averageGrade = $gradeCount > 0 ? round($gradeSum / $gradeCount, 1) : null;
        
        require_once __DIR__ . '/../views/student/dashboard.php';
    }
}
?>
