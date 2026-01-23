<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\Work;
use App\Models\WorkAssignment;

class WorkController
{
    public function index()
    {
        Auth::requireTeacher();
        $workModel = new Work();
        $works = $workModel->getByTeacher((int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/works/index.php';
    }

    public function create()
    {
        Auth::requireTeacher();
        $classeModel = new Classe();
        $classes = $classeModel->getAllByTeacher((int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/works/create.php';
    }

    public function store()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /works/create');
            exit;
        }

        $classId = (int) ($_POST['class_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        if ($classId <= 0 || $title === '') {
            header('Location: /works/create');
            exit;
        }

        $classeModel = new Classe();
        $class = $classeModel->getById($classId);
        if (!$class || (int) $class['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /works/create');
            exit;
        }

        $filePath = null;
        if (!empty($_FILES['attachment']['name'])) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/works';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $safeName = time() . '_' . basename($_FILES['attachment']['name']);
            $target = $uploadDir . '/' . $safeName;
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) {
                $filePath = '/uploads/works/' . $safeName;
            }
        }

        $workModel = new Work();
        $workModel->create($classId, $title, $description, $filePath);

        header('Location: /works');
        exit;
    }

    public function assignForm()
    {
        Auth::requireTeacher();
        $workId = (int) ($_GET['id'] ?? 0);
        if ($workId <= 0) {
            header('Location: /works');
            exit;
        }

        $workModel = new Work();
        $work = $workModel->getById($workId);
        if (!$work || (int) $work['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /works');
            exit;
        }

        $classStudent = new ClassStudent();
        $students = $classStudent->getStudentsByClass((int) $work['class_id']);

        $assignmentModel = new WorkAssignment();
        $assigned = $assignmentModel->getAssignedStudents($workId);
        $assignedIds = array_map(static function ($row) {
            return (int) $row['id'];
        }, $assigned);

        require_once dirname(__DIR__) . '/views/works/assign.php';
    }

    public function assign()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /works');
            exit;
        }

        $workId = (int) ($_POST['work_id'] ?? 0);
        $studentIds = $_POST['student_ids'] ?? [];
        if (!is_array($studentIds) && $studentIds !== null && $studentIds !== '') {
            $studentIds = [$studentIds];
        }
        if ($workId <= 0 || !is_array($studentIds)) {
            header('Location: /works');
            exit;
        }

        $workModel = new Work();
        $work = $workModel->getById($workId);
        if (!$work || (int) $work['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /works');
            exit;
        }

        $assignmentModel = new WorkAssignment();
        $assignmentModel->assignMany($workId, $studentIds);

        header('Location: /works/assign?id=' . $workId);
        exit;
    }
}
