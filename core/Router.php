<?php
/** Simple Router for the PHP MVC skeleton */
class Router {
    protected $routes = [];

    public function addRoute(string $path, string $controller, string $action) {
        $this->routes[$path] = [$controller, $action];
    }

    public function dispatch(string $path) {
        if (isset($this->routes[$path])) {
            [$controller, $action] = $this->routes[$path];
            $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controller)) {
                    $obj = new $controller();
                    if (method_exists($obj, $action)) {
                        $obj->$action();
                        return;
                    }
                }
            }
        }
        // Fallback: try HomeController@index
        $fallback = ['HomeController', 'index'];
        [$fc, $fa] = $fallback;
        $file = __DIR__ . '/../app/controllers/' . $fc . '.php';
        if (file_exists($file)) {
            require_once $file;
            if (class_exists($fc)) {
                $obj = new $fc();
                if (method_exists($obj, $fa)) {
                    $obj->$fa();
                    return;
                }
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }
}
