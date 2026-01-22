<?php

namespace App\Controllers;

use App\Models\Classe;
use App\Models\User;

class ClassController
{

    public function index()
    {
        $classeModel = new Classe();
        $classes = $classeModel->getAll();

        require_once dirname(__DIR__) . '/views/classes/index.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $teacher_id = $_POST['teacher_id'];
            $classeModel = new Classe();
            if ($classeModel->create($name, $teacher_id)) {
                header('Location: /classes');
                exit;
            }
        }
        require_once dirname(__DIR__) . '/views/classes/create.php';
    }
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $classeModel = new Classe();
            $classeModel->delete($id);
        }
        header('Location; /classes');
        exit ;
    }

    // Afficher les détails d'une classe et ses étudiants
    public function show()
    {
        if (!isset($_GET['id'])) {
            header('Location: /classes');
            exit;
        }

        $class_id = $_GET['id'];
        $classeModel = new Classe();
        $classe = $classeModel->getById($class_id);
        $students = $classeModel->getStudents($class_id);

        if (!$classe) {
            header('Location: /classes');
            exit;
        }

        require_once dirname(__DIR__) . '/views/classes/show.php';
    }

    // Afficher le formulaire pour ajouter des étudiants
    public function assignStudents()
    {
        if (!isset($_GET['id'])) {
            header('Location: /classes');
            exit;
        }

        $class_id = $_GET['id'];
        $classeModel = new Classe();
        $classe = $classeModel->getById($class_id);

        if (!$classe) {
            header('Location: /classes');
            exit;
        }

        $userModel = new User();
        $unassignedStudents = $userModel->getUnassignedStudents($class_id);

        require_once dirname(__DIR__) . '/views/classes/assign_students.php';
    }

    // Ajouter un étudiant à une classe
    public function addStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class_id = $_POST['class_id'];
            $student_ids = isset($_POST['student_ids']) ? $_POST['student_ids'] : [];

            if (empty($student_ids)) {
                $_SESSION['error'] = "Veuillez sélectionner au moins un étudiant.";
                header('Location: /classes/assign-students?id=' . $class_id);
                exit;
            }

            $classeModel = new Classe();
            $added_count = 0;
            $failed_count = 0;

            foreach ($student_ids as $student_id) {
                if ($classeModel->addStudent($class_id, $student_id)) {
                    $added_count++;
                } else {
                    $failed_count++;
                }
            }

            if ($added_count > 0) {
                $_SESSION['success'] = "$added_count étudiant(s) ajouté(s) à la classe!";
            }
            if ($failed_count > 0) {
                $_SESSION['warning'] = "$failed_count étudiant(s) ne pouvaient pas être ajoutés (déjà présents?).";
            }

            header('Location: /classes/show?id=' . $class_id);
            exit;
        }
    }

    // Supprimer un étudiant d'une classe
    public function removeStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $class_id = $_POST['class_id'];
            $student_id = $_POST['student_id'];

            $classeModel = new Classe();
            if ($classeModel->removeStudent($class_id, $student_id)) {
                $_SESSION['success'] = "Étudiant supprimé de la classe!";
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression de l'étudiant.";
            }

            header('Location: /classes/show?id=' . $class_id);
            exit;
        }
    }
}
