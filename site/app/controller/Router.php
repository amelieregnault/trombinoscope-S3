<?php

namespace app\controller;


class Router extends Controller
{

    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute(string $name, Controller $controller, string $method)
    {
        $this->routes[$name] = new Route($controller, $method);
    }

    public function callRoute(string $name)
    {
        if (!key_exists($name, $this->routes)) {
            $this->redirectToPageWithError('index.php?page=erreur', "Page inconnue");
        }
        
        $route = $this->routes[$name];
        if ($route->isAvailable()) {
            $route->execute();
        } else {
            $this->redirectToPageWithError('index.php?page=erreur', "Méthode non existante");
        }
    }
}
