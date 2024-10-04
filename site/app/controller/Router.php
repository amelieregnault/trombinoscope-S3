<?php

class Router
{

    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute(string $name, Controller $controller, string $method)
    {
        $this->routes[$name] = ['controller' => $controller, 'method' => $method];
    }

    public function callRoute(string $name)
    {
        if (!key_exists($name, $this->routes)) {
            $errorController = new ErrorController();
            $errorController->genererPageErreur('Page inconnue');
            exit();
        }

        $route = $this->routes[$name];
        $controller = $route['controller'];
        $method = $route['method'];
        if (method_exists($controller, $method) && is_callable([$controller, $method])) {
            $controller->$method();
        } else {
            $errorController = new ErrorController();
            $errorController->genererPageErreur('Méthode non existante');
        }
    }
}
