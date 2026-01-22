<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $class = str_replace('App\\', '', $class);
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../app/' . $class . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;

// Create router instance
$router = new Router();

// Define routes
// Home
$router->get('/', 'AuthController', 'showLogin');
$router->get('/home', 'AuthController', 'showLogin');

// Auth routes
$router->get('/auth/login', 'AuthController', 'showLogin');
$router->post('/auth/login', 'AuthController', 'login');
$router->post('/auth/register', 'AuthController', 'register');
$router->get('/auth/logout', 'AuthController', 'logout');

// Student routes
$router->get('/student/dashboard', 'StudentController', 'dashboard');

// Teacher routes
$router->get('/teacher/dashboard', 'TeacherController', 'dashboard');

// Class routes
$router->get('/classes', 'ClassController', 'index');
$router->get('/classes/create', 'ClassController', 'create');
$router->post('/classes/store', 'ClassController', 'store');

// Dispatch the request
$router->dispatch();
?>