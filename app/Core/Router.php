<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $handler) {
        $this->routes['GET'][$this->formatPath($path)] = $handler;
    }

    public function post($path, $handler) {
        $this->routes['POST'][$this->formatPath($path)] = $handler;
    }

    private function formatPath($path) {
        $p = trim($path, '/');
        return $p === '' ? '/' : '/' . $p;
    }

    public function run() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Sesuaikan path jika aplikasi diletakkan di dalam subfolder
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir));
        }

        $uri = $this->formatPath($uri);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            [$controllerClass, $methodName] = $this->routes[$method][$uri];
            $controller = new $controllerClass();
            $controller->$methodName();
        } else {
            http_response_code(404);
            require_once __DIR__ . '/../Views/errors/404.php';
        }
    }
}
