<?php
namespace App\Controllers;

use App\Models\Work;
use App\Models\Submission;
use App\Core\Auth;

class SubmissionController {

    // Afficher les devoirs pour un étudiant
    public function myWorks() {
        Auth::requireStudent();
        
        $student_id = $_SESSION['user_id'];
        $workModel = new Work();
        $works = $workModel->getStudentWorksWithSubmissions($student_id);

        require_once dirname(__DIR__) . '/views/submissions/my_works.php';
    }

    // Afficher un devoir spécifique avec formulaire de soumission
    public function show() {
        Auth::requireStudent();
        
        if (!isset($_GET['id'])) {
            header('Location: /submissions/my-works');
            exit;
        }

        $work_id = $_GET['id'];
        $student_id = $_SESSION['user_id'];

        $workModel = new Work();
        $work = $workModel->getById($work_id);

        if (!$work) {
            header('Location: /submissions/my-works');
            exit;
        }

        $submissionModel = new Submission();
        $submission = $submissionModel->getStudentSubmission($work_id, $student_id);

        require_once dirname(__DIR__) . '/views/submissions/show.php';
    }

    // Soumettre/Mettre à jour une soumission
    public function submit() {
        Auth::requireStudent();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /submissions/my-works');
            exit;
        }

        $work_id = $_POST['work_id'] ?? null;
        $student_id = $_SESSION['user_id'];
        $content = $_POST['content'] ?? '';
        $file_path = null;

        if (!$work_id) {
            $_SESSION['error'] = "Devoir introuvable.";
            header('Location: /submissions/my-works');
            exit;
        }

        // Vérifier si le devoir existe
        $workModel = new Work();
        $work = $workModel->getById($work_id);

        if (!$work) {
            $_SESSION['error'] = "Devoir introuvable.";
            header('Location: /submissions/my-works');
            exit;
        }

        // Gérer l'upload de fichier
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploads_dir = dirname(__DIR__, 2) . '/public/uploads';
            
            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0777, true);
            }

            $file_name = time() . '_' . basename($_FILES['file']['name']);
            $file_path = '/uploads/' . $file_name;
            $full_path = $uploads_dir . '/' . $file_name;

            // Vérifier la taille (max 10MB)
            if ($_FILES['file']['size'] > 10 * 1024 * 1024) {
                $_SESSION['error'] = "Le fichier est trop volumineux (max 10MB).";
                header('Location: /submissions/show?id=' . $work_id);
                exit;
            }

            // Vérifier le type de fichier
            $allowed_types = ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'zip'];
            $file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            
            if (!in_array($file_ext, $allowed_types)) {
                $_SESSION['error'] = "Type de fichier non autorisé.";
                header('Location: /submissions/show?id=' . $work_id);
                exit;
            }

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $full_path)) {
                $_SESSION['error'] = "Erreur lors du téléchargement du fichier.";
                header('Location: /submissions/show?id=' . $work_id);
                exit;
            }
        }

        // Vérifier s'il y a du contenu
        if (empty($content) && empty($file_path)) {
            $_SESSION['error'] = "Veuillez soumettre du texte ou un fichier.";
            header('Location: /submissions/show?id=' . $work_id);
            exit;
        }

        $submissionModel = new Submission();
        $existingSubmission = $submissionModel->getStudentSubmission($work_id, $student_id);

        if ($existingSubmission) {
            // Mettre à jour la soumission existante
            if ($submissionModel->update($existingSubmission['id'], $content, $file_path)) {
                $_SESSION['success'] = "Soumission mise à jour!";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour.";
            }
        } else {
            // Créer une nouvelle soumission
            if ($submissionModel->create($work_id, $student_id, $content, $file_path)) {
                $_SESSION['success'] = "Soumission envoyée!";
            } else {
                $_SESSION['error'] = "Erreur lors de l'envoi.";
            }
        }

        header('Location: /submissions/show?id=' . $work_id);
        exit;
    }
}
?>
