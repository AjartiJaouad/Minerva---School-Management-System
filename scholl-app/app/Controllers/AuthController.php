<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Database;

class AuthController {
    
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Show login page
    public function showLogin() {
        Auth::start();
        
        // If already logged in, redirect to dashboard
        if (Auth::isLoggedIn()) {
            $role = Auth::getRole();
            header("Location: /" . $role . "/dashboard");
            exit;
        }
        
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    // Handle login
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
            
            // Verify user exists and password is correct
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
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
                
            } else {
                $_SESSION['error'] = 'Email ou mot de passe incorrect';
                header('Location: /auth/login');
                exit;
            }
            
        } catch (\PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            $_SESSION['error'] = 'Erreur de connexion. Veuillez réessayer.';
            header('Location: /auth/login');
            exit;
        }
    }
    
    // Handle registration
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
            
            if ($checkStmt->fetch()) {
                $_SESSION['error'] = 'Cet email est déjà utilisé';
                header('Location: /auth/login');
                exit;
            }
            
            // Hash password
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
    
    // Handle logout
    public function logout() {
        Auth::start();
        
        // Clear remember me cookie
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        
        // Destroy session
        session_unset();
        session_destroy();
        
        // Redirect to home
        header('Location: /');
        exit;
    }
}
?>
