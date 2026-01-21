<?php

session_start();

require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Auth.php';
require_once '../app/Models/User.php';
require_once '../app/Models/Classe.php'; 
require_once '../app/Controllers/AuthController.php';
require_once '../app/Controllers/ClassController.php'; 
use App\Controllers\AuthController;
use App\Core\Auth;
use App\Controllers\ClassController;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Nettoyage de l'URI pour marcher sur localhost/dossier...
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($scriptName, '', $uri);

$uri = explode('?', $uri)[0];

if ($uri === '') $uri = '/';

switch ($uri) {
    
    case '/':
    case '/login':
        $controller = new AuthController();
        if ($method === 'POST') {
            $controller->login();
        } else {
            $controller->showLoginForm();
        }
        break;

    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    
    case '/teacher/dashboard':
        Auth::requireTeacher(); 
        echo "<h1>👋 Bienvenue Cher Professeur</h1>";
        echo "<p>Ceci est votre espace privé.</p>";
        // Hna zedt lien bch ymchi l les classes dylou
        echo "<a href='/classes' style='background:blue; color:white; padding:10px; text-decoration:none;'>🏫 Gérer mes classes</a><br><br>";
        echo "<a href='/logout'>Se déconnecter</a>";
        break;

    case '/student/dashboard':
        Auth::requireStudent();
        echo "<h1>👋 Salut Étudiant</h1>";
        echo "<p>Ceci est ton espace de cours.</p>";
        echo "<a href='/logout'>Se déconnecter</a>";
        break;

   
    case '/classes':
        Auth::requireTeacher(); // Hmaya: ghir l prof li ydkhl
        $controller = new ClassController();
        $controller->index();
        break;

    case '/classes/create':
        Auth::requireTeacher();
        $controller = new ClassController();
        $controller->create();
        break;

    case '/classes/delete':
        Auth::requireTeacher();
        $controller = new ClassController();
        $controller->delete();
        break;

  
    default:
        http_response_code(404);
        echo "<h1>404 - Page introuvable</h1>";
        break;
}