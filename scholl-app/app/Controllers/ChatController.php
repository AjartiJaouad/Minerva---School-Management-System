<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\ChatMessage;
use App\Models\Classe;
use App\Models\ClassStudent;

class ChatController
{
    public function index()
    {
        Auth::requireLogin();
        $classeModel = new Classe();

        if (Auth::getRole() === 'teacher') {
            $classes = $classeModel->getAllByTeacher((int) Auth::getUserId());
        } else {
            $classes = $classeModel->getByStudent((int) Auth::getUserId());
        }

        require_once dirname(__DIR__) . '/views/chat/index.php';
    }

    public function view()
    {
        Auth::requireLogin();
        $classId = (int) ($_GET['class_id'] ?? 0);
        if ($classId <= 0) {
            header('Location: /chat');
            exit;
        }

        if (!$this->canAccessClass($classId)) {
            header('Location: /chat');
            exit;
        }

        $chatModel = new ChatMessage();
        $messages = $chatModel->getByClass($classId);

        $classeModel = new Classe();
        $class = $classeModel->getById($classId);

        require_once dirname(__DIR__) . '/views/chat/view.php';
    }

    public function send()
    {
        Auth::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /chat');
            exit;
        }

        $classId = (int) ($_POST['class_id'] ?? 0);
        $message = trim($_POST['message'] ?? '');
        if ($classId <= 0 || $message === '') {
            header('Location: /chat');
            exit;
        }

        if (!$this->canAccessClass($classId)) {
            header('Location: /chat');
            exit;
        }

        $chatModel = new ChatMessage();
        $chatModel->create($classId, (int) Auth::getUserId(), $message);

        header('Location: /chat/view?class_id=' . $classId);
        exit;
    }

    private function canAccessClass(int $classId): bool
    {
        $classeModel = new Classe();
        $class = $classeModel->getById($classId);
        if (!$class) {
            return false;
        }

        if (Auth::getRole() === 'teacher') {
            return (int) $class['teacher_id'] === (int) Auth::getUserId();
        }

        $classStudent = new ClassStudent();
        $students = $classStudent->getStudentsByClass($classId);
        foreach ($students as $student) {
            if ((int) $student['id'] === (int) Auth::getUserId()) {
                return true;
            }
        }

        return false;
    }
}
