<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Grade;
use App\Models\Submission;
use App\Models\Work;

class GradeController
{
    public function work()
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

        $submissionModel = new Submission();
        $submissions = $submissionModel->getByWork($workId);

        $gradeModel = new Grade();
        $grades = [];
        foreach ($submissions as $submission) {
            $grades[$submission['id']] = $gradeModel->getBySubmissionId((int) $submission['id']);
        }

        require_once dirname(__DIR__) . '/views/grades/work.php';
    }

    public function save()
    {
        Auth::requireTeacher();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /works');
            exit;
        }

        $submissionId = (int) ($_POST['submission_id'] ?? 0);
        $workId = (int) ($_POST['work_id'] ?? 0);
        $gradeValue = (float) ($_POST['grade'] ?? 0);
        $comment = trim($_POST['comment'] ?? '');
        if ($submissionId <= 0 || $workId <= 0) {
            header('Location: /works');
            exit;
        }

        $workModel = new Work();
        $work = $workModel->getById($workId);
        if (!$work || (int) $work['teacher_id'] !== (int) Auth::getUserId()) {
            header('Location: /works');
            exit;
        }

        $gradeModel = new Grade();
        $gradeModel->createOrUpdate($submissionId, $gradeValue, $comment);

        header('Location: /grades/work?id=' . $workId);
        exit;
    }

    public function student()
    {
        Auth::requireStudent();
        $gradeModel = new Grade();
        $grades = $gradeModel->getByStudent((int) Auth::getUserId());

        require_once dirname(__DIR__) . '/views/student/grades.php';
    }
}
