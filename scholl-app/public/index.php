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
$router->get('/', 'HomeController', 'index');
$router->get('/home', 'HomeController', 'index');

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
$router->get('/classes/manage', 'ClassController', 'manage');
$router->post('/classes/assign', 'ClassController', 'assign');
$router->post('/classes/remove', 'ClassController', 'remove');
$router->get('/classes/delete', 'ClassController', 'delete');

// Work routes (teacher)
$router->get('/works', 'WorkController', 'index');
$router->get('/works/create', 'WorkController', 'create');
$router->post('/works/store', 'WorkController', 'store');
$router->get('/works/assign', 'WorkController', 'assignForm');
$router->post('/works/assign', 'WorkController', 'assign');

// Work routes (student)
$router->get('/student/works', 'StudentWorkController', 'index');
$router->get('/student/works/submit', 'StudentWorkController', 'submitForm');
$router->post('/student/works/submit', 'StudentWorkController', 'submit');

// Grades
$router->get('/grades/work', 'GradeController', 'work');
$router->post('/grades/save', 'GradeController', 'save');
$router->get('/student/grades', 'GradeController', 'student');

// Attendance
$router->get('/attendance', 'AttendanceController', 'mark');
$router->post('/attendance/save', 'AttendanceController', 'save');
$router->get('/student/attendance', 'AttendanceController', 'student');

// Chat
$router->get('/chat', 'ChatController', 'index');
$router->get('/chat/view', 'ChatController', 'view');
$router->post('/chat/send', 'ChatController', 'send');

// Students (teacher)
$router->get('/students/create', 'StudentManagementController', 'create');
$router->post('/students/store', 'StudentManagementController', 'store');

// Dispatch the request
$router->dispatch();
?>
