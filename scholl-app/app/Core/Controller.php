<?php
namespace App\Core;

class Controller {
    protected function render($view, $data = []) {
        extract($data);
        $viewFile = dirname(__DIR__) . "/views/" . $view . ".php";

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Erreur : La vue '$viewFile' n'existe pas !");
        }
    }
}
