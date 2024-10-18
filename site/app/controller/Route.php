<?php

namespace app\controller;

class Route
{
    /* Méthode classique */
    // private Controller $controller;
    // private string $method;

    // public function __construct(Controller $controller, string $method)
    // {
    //     $this->controller = $controller;
    //     $this->method = $method;
    // }

    public function __construct(private Controller $controller, private string $method) {}

    public function isAvailable(): bool
    {
        return method_exists($this->controller, $this->method) && 
               is_callable([$this->controller, $this->method]);
    }

    public function execute(){
        $method = $this->method;
        $this->controller->$method();
    }

    /**
     * Get the value of controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Get the value of method
     */
    public function getMethod()
    {
        return $this->method;
    }
}