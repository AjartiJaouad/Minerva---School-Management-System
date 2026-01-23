<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Classe;
use App\Models\ClassStudent;

class ClassController
{

    public function index()
    {
        $classeModel = new Classe();
        Auth::requireTeacher();
        $teacherId = Auth::getUserId();
        $classes = $classeModel->getAllByTeacher((int) $teacherId);

        require_once dirname(__DIR__) . '/views/classes/index.php';
    }
    public function create()
    {
        Auth::requireTeacher();
        require_once dirname(__DIR__) . '/views/classes/create.php';
    }
    public function store()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /classes/create');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $teacher_id = Auth::getUserId();

        if ($name === '' || empty($teacher_id)) {
            header('Location: /classes/create');
            exit;
        }

        $classeModel = new Classe();
        if ($classeModel->create($name, (int) $teacher_id)) {
            header('Location: /classes');
            exit;
        }

        header('Location: /classes/create');
        exit;
    }

    public function manage()
    {
        Auth::requireTeacher();
        $classId = (int) ($_GET['id'] ?? 0);
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
        $availableStudents = $classStudent->getAvailableStudents($classId);

        require_once dirname(__DIR__) . '/views/classes/manage.php';
    }

    public function assign()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /classes');
            exit;
        }

        $classId = (int) ($_POST['class_id'] ?? 0);
        $studentId = (int) ($_POST['student_id'] ?? 0);
        if ($classId <= 0 || $studentId <= 0) {
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
        $classStudent->assign($classId, $studentId);

        header('Location: /classes/manage?id=' . $classId);
        exit;
    }

    public function remove()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /classes');
            exit;
        }

        $classId = (int) ($_POST['class_id'] ?? 0);
        $studentId = (int) ($_POST['student_id'] ?? 0);
        if ($classId <= 0 || $studentId <= 0) {
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
        $classStudent->remove($classId, $studentId);

        header('Location: /classes/manage?id=' . $classId);
        exit;
    }
    public function delete()
    {
        Auth::requireTeacher();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $classeModel = new Classe();
            $classeModel->delete($id);
        }
        header('Location: /classes');
        exit;
    }
}
