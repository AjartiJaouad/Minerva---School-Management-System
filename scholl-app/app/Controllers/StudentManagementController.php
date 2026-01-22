<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Classe;
use App\Models\ClassStudent;
use App\Models\User;

class StudentManagementController
{
    public function create()
    {
        Auth::requireTeacher();
        $classeModel = new Classe();
        $classes = $classeModel->getAllByTeacher((int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/students/create.php';
    }

    public function store()
    {
        Auth::requireTeacher();
        Auth::start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /students/create');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $classId = (int) ($_POST['class_id'] ?? 0);

        if ($name === '' || $email === '') {
            $_SESSION['error'] = 'Nom et email requis.';
            header('Location: /students/create');
            exit;
        }

        $password = bin2hex(random_bytes(4));
        $userModel = new User();
        $studentId = $userModel->createWithId($name, $email, $password, 'student');

        if (!$studentId) {
            $_SESSION['error'] = 'Creation echouee.';
            header('Location: /students/create');
            exit;
        }

        if ($classId > 0) {
            $classStudent = new ClassStudent();
            $classStudent->assign($classId, $studentId);
        }

        $_SESSION['success'] = 'Etudiant cree. Mot de passe: ' . $password;
        header('Location: /students/create');
        exit;
    }
}
