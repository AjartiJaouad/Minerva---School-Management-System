<?php
namespace App\Core;

class Router {
    
    private $routes = [];
    
    public function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function get($path, $controller, $action) {
        $this->add('GET', $path, $controller, $action);
    }
    
    public function post($path, $controller, $action) {
        $this->add('POST', $path, $controller, $action);
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        
        // Remove query string
        $requestUri = strtok($requestUri, '?');
        
        // Remove trailing slash
        $requestUri = rtrim($requestUri, '/');
        
        // If empty, set to /
        if (empty($requestUri)) {
            $requestUri = '/';
        }
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->matchRoute($route['path'], $requestUri)) {
                $controllerName = "App\\Controllers\\" . $route['controller'];
                
                if (!class_exists($controllerName)) {
                    http_response_code(500);
                    die("Controller {$controllerName} not found");
                }
                
                $controller = new $controllerName();
                $action = $route['action'];
                
                if (!method_exists($controller, $action)) {
                    http_response_code(500);
                    die("Action {$action} not found in controller");
                }
                
                return $controller->$action();
            }
        }
        
        // No route found
        http_response_code(404);
        echo "404 - Page not found";
    }
    
    private function matchRoute($routePath, $requestUri) {
        // Simple exact match for now
        // You can add parameter matching later if needed
        return $routePath === $requestUri;
    }
}
?>