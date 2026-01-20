<?php
require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Auth.php';
require_once '../app/Models/User.php';
require_once '../app/Controllers/AuthController.php';

use App\Controllers\AuthController;
use App\Core\Auth;
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($scriptName, '', $uri);
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
        Auth::requireLogin();
        echo "<h1>Espace Professeur</h1><p>Connecté en tant que : " . Auth::getUserName() . "</p>";
        break;

    case '/student/dashboard':
        Auth::requireLogin();
        echo "<h1>Espace Étudiant</h1><p>Connecté en tant que : " . Auth::getUserName() . "</p>";
        break;

    default:
        http_response_code(404);
        echo "404 - Page non trouvée";
        break;
}