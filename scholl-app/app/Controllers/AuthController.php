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
        Auth::start();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/login');
            exit;
        }
        
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'student';
        
        // Validate inputs
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs';
            header('Location: /auth/login');
            exit;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email invalide';
            header('Location: /auth/login');
            exit;
        }
        
        try {
            $table = 'users';
            
            $sql = "SELECT * FROM {$table} WHERE email = :email AND role = :role LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['email' => $email, 'role' => $role]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            
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
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $role;
                
                // Handle remember me (cookie only; no DB column defined)
                if (isset($_POST['remember'])) {
                    $token = bin2hex(random_bytes(32));
                    setcookie('remember_token', $token, time() + (86400 * 30), '/');
                }
                
                $_SESSION['success'] = 'Connexion réussie!';
                
                // Redirect based on role
                header("Location: /{$role}/dashboard");
                exit;
                
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
        Auth::start();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/login');
            exit;
        }
        
        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $role = $_POST['role'] ?? 'student';
        
        // Validate inputs
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs';
            header('Location: /auth/login');
            exit;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email invalide';
            header('Location: /auth/login');
            exit;
        }
        
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Les mots de passe ne correspondent pas';
            header('Location: /auth/login');
            exit;
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Le mot de passe doit contenir au moins 6 caractères';
            header('Location: /auth/login');
            exit;
        }
        
        try {
            $table = 'users';
            
            // Check if email already exists
            $checkSql = "SELECT id FROM {$table} WHERE email = :email LIMIT 1";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->execute(['email' => $email]);
            
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
            
            // Insert new user
            $insertSql = "INSERT INTO {$table} (name, email, password, role, created_at) 
                         VALUES (:name, :email, :password, :role, NOW())";
            
            $insertStmt = $this->db->prepare($insertSql);
            $insertStmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ]);
            
            // Get the newly created user's ID
            $userId = $this->db->lastInsertId();
            
            // Log the user in automatically
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;
            
            $_SESSION['success'] = 'Inscription réussie! Bienvenue sur EduConnect.';
            
            // Redirect based on role
            header("Location: /{$role}/dashboard");
            exit;
            
        } catch (\PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            $_SESSION['error'] = 'Erreur lors de l\'inscription. Veuillez réessayer.';
            header('Location: /auth/login');
            exit;
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
?>
