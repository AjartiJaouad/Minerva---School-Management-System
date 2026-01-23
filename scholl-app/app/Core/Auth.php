<?php
namespace App\Core;

class Auth {

    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isLoggedIn() {
        self::start();
        return isset($_SESSION['user_id']);
    }
 
    public static function getRole() {
        self::start();
        return $_SESSION['role'] ?? null;
    }

    public static function getUserName() {
        self::start();
        return $_SESSION['name'] ?? 'Invité';
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }


    public static function requireTeacher(){
        self::requireLogin();
        
        $role = self::getRole();
        if($role !== 'teacher' && $role !== 'enseignant'){
            header('Location: /student/dashboard');
            exit;
        }
    }

    public static function requireStudent(){
        self::requireLogin();
        
        if(self::getRole() !== 'student'){
            header('Location: /teacher/dashboard');
            exit;
        }
    }
}