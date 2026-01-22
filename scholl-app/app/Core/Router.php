<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $controller, $action) {
        $this->add('GET', $path, $controller, $action);
    }

    public function post($path, $controller, $action) {
        $this->add('POST', $path, $controller, $action);
    }

    private function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        $uri = str_replace($scriptName, '', $uri);
        $uri = explode('?', $uri)[0];
        
        if ($uri === '') $uri = '/';

        foreach ($this->routes as $route) {
            if ($route['path'] === $uri && $route['method'] === $method) {
                
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $action = $route['action'];

                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        return;
                    } else {
                        die("Erreur : La méthode $action n'existe pas dans $controllerClass");
                    }
                } else {
                    die("Erreur : Le contrôleur $controllerClass n'existe pas");
                }
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page Introuvable</h1>";
    }
}