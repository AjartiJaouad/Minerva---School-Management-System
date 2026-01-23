<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Submission;
use App\Models\Work;
use App\Models\WorkAssignment;

class StudentWorkController
{
    public function index()
    {
        Auth::requireStudent();
        $assignmentModel = new WorkAssignment();
        $works = $assignmentModel->getAssignedWorksByStudent((int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/student/works.php';
    }

    public function submitForm()
    {
        Auth::requireStudent();
        $workId = (int) ($_GET['id'] ?? 0);
        if ($workId <= 0) {
            header('Location: /student/works');
            exit;
        }

        $workModel = new Work();
        $work = $workModel->getById($workId);
        if (!$work) {
            header('Location: /student/works');
            exit;
        }

        $assignmentModel = new WorkAssignment();
        if (!$assignmentModel->isAssigned($workId, (int) Auth::getUserId())) {
            header('Location: /student/works');
            exit;
        }

        $submissionModel = new Submission();
        $submission = $submissionModel->getByStudentWork($workId, (int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/student/submit_work.php';
    }

    public function submit()
    {
        Auth::requireStudent();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /student/works');
            exit;
        }

        $workId = (int) ($_POST['work_id'] ?? 0);
        if ($workId <= 0) {
            header('Location: /student/works');
            exit;
        }

        $assignmentModel = new WorkAssignment();
        if (!$assignmentModel->isAssigned($workId, (int) Auth::getUserId())) {
            header('Location: /student/works');
            exit;
        }

        $content = trim($_POST['content'] ?? '');
        $filePath = null;
        if (!empty($_FILES['attachment']['name'])) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/submissions';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $safeName = time() . '_' . basename($_FILES['attachment']['name']);
            $target = $uploadDir . '/' . $safeName;
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) {
                $filePath = '/uploads/submissions/' . $safeName;
            }
        }

        $submissionModel = new Submission();
        $submissionModel->createOrUpdate($workId, (int) Auth::getUserId(), $content, $filePath);

        header('Location: /student/works');
        exit;
    }
}
