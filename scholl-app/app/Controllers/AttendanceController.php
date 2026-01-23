<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Attendance;
use App\Models\Classe;
use App\Models\ClassStudent;

class AttendanceController
{
    public function mark()
    {
        Auth::requireTeacher();
        $classId = (int) ($_GET['class_id'] ?? 0);
        $date = $_GET['date'] ?? date('Y-m-d');
        if ($classId <= 0) {
            header('Location: /classes');
            exit;
        }

        $classeModel = new Classe();
        $class = $classeModel->getById($classId);
        if (!$class || (int) $class['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /classes');
            exit;
        }

        $classStudent = new ClassStudent();
        $students = $classStudent->getStudentsByClass($classId);

        $attendanceModel = new Attendance();
        $statuses = $attendanceModel->getByClassDate($classId, $date);

        require_once dirname(__DIR__) . '/views/attendance/mark.php';
    }

    public function save()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /classes');
            exit;
        }

        $classId = (int) ($_POST['class_id'] ?? 0);
        $date = $_POST['date'] ?? date('Y-m-d');
        $statuses = $_POST['status'] ?? [];
        if ($classId <= 0 || !is_array($statuses)) {
            header('Location: /classes');
            exit;
        }

        $classeModel = new Classe();
        $class = $classeModel->getById($classId);
        if (!$class || (int) $class['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /classes');
            exit;
        }

        $attendanceModel = new Attendance();
        foreach ($statuses as $studentId => $status) {
            $status = $status === 'present' ? 'present' : 'absent';
            $attendanceModel->createOrUpdate($classId, (int) $studentId, $date, $status);
        }

        header('Location: /attendance?class_id=' . $classId . '&date=' . $date);
        exit;
    }

    public function student()
    {
        Auth::requireStudent();
        $attendanceModel = new Attendance();
        $records = $attendanceModel->getByStudent((int) Auth::getUserId());

        $total = count($records);
        $present = 0;
        foreach ($records as $record) {
            if ($record['status'] === 'present') {
                $present++;
            }
        }
        $percentage = $total > 0 ? round(($present / $total) * 100, 1) : 0;

        require_once dirname(__DIR__) . '/views/student/attendance.php';
    }
    //test push 
}
