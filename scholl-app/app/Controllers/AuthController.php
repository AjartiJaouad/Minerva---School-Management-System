<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\Auth;

class AuthController {

    // 1. Afficher le formulaire de connexion
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            $this->redirectUser($_SESSION['role']);
        }
        require_once dirname(__DIR__) . '/views/auth/login.php';
    }

    // 2. Traiter la connexion (Login)
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Nettoyage des données
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // Appel au Model
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            // Vérification
            if ($user && password_verify($password, $user['password'])) {
                // Création de la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nom'] = $user['name']; 
                
                $this->redirectUser($user['role']);
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header('Location: /login');
                exit;
            }
        }
    }

    // 3. Traiter l'inscription (Register)
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $role = $_POST['role'];

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                header('Location: /login'); 
                exit;
            }

            $userModel = new User();

            if ($userModel->findByEmail($email)) {
                $_SESSION['error'] = "Cet email est déjà utilisé.";
                header('Location: /login');
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'name' => $name, 
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ];

            if ($userModel->create($data)) {
                $_SESSION['success'] = "Compte créé ! Connectez-vous.";
                header('Location: /login');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription.";
                header('Location: /login');
                exit;
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    // --- Dashboards ---

    public function teacherDashboard() {
       
        $viewPath = dirname(__DIR__) . '/views/teatcher/dashboard.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "Erreur : La vue dashboard.php n'existe pas dans views/teacher/";
        }
    }

    public function studentDashboard() {
        require_once dirname(__DIR__) . '/views/student/dashboard.php';
    }

    private function redirectUser($role) {
        if ($role === 'enseignant' || $role === 'teacher') {
            header('Location: /teacher/dashboard'); 
        } else {
            header('Location: /student/dashboard');
        }
        exit;
    }
}