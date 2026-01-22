<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


spl_autoload_register(function ($class) {
    $class = str_replace('App\\', '', $class);
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../app/' . $class . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;

$router = new Router();



$router->get('/', 'AuthController', 'showLogin');
$router->get('/home', 'AuthController', 'showLogin'); 
$router->get('/login', 'AuthController', 'showLogin'); 

$router->get('/auth/login', 'AuthController', 'showLogin'); 
$router->post('/auth/login', 'AuthController', 'login');
$router->post('/auth/register', 'AuthController', 'register');
$router->get('/logout', 'AuthController', 'logout'); 


$router->get('/student/dashboard', 'AuthController', 'studentDashboard');
$router->get('/teatcher/dashboard', 'AuthController', 'teacherDashboard');

$router->get('/classes', 'ClassController', 'index');
$router->get('/classes/create', 'ClassController', 'create');
$router->post('/classes/store', 'ClassController', 'store');

$router->dispatch();
?>