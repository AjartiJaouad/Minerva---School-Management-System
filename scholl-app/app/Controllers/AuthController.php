<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Auth;

class AuthController extends Controller {

    // 1. Afficher la page de Login
    public function showLoginForm() {
        // Si le gars est déjà connecté, on le vire vers son Dashboard direct
        if (Auth::isLoggedIn()) {
            $this->redirectUser();
        }
        
        // Sinon, on affiche le formulaire HTML
        $this->render('auth/login');
    }

    // 2. Traiter le formulaire (POST)
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Nettoyage basique des entrées
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // Appeler le Modèle pour chercher l'utilisateur
            $userModel = new User();
            $user = $userModel->findByEmail($email);

            // --- VÉRIFICATION DU MOT DE PASSE (HASH) ---
            if ($user && password_verify($password, $user['password'])) {
                
                // C'est bon ! On démarre la session via ton Middleware
                Auth::start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                
                $_SESSION['name'] = $user['name']; 

                $this->redirectUser();

            } else {
                $this->render('auth/login', ['error' => 'Email ou mot de passe incorrect']);
            }
        }
    }

    // Se déconnecter
    public function logout() {
        Auth::start();
        session_destroy(); 
        
        header('Location: /login');
        exit;
    }

    private function redirectUser() {
        if ($_SESSION['role'] === 'teacher') {
            header('Location: /teacher/dashboard');
        } else {
            header('Location: /student/dashboard');
        }
        exit;
    }
}