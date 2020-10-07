<?php

namespace SofiB\Delivery\Common;

class Router
{
    private $routes;

    public function __construct ()
    {
        $this->routes = Route\Set::create(); 
    }

    public function addRoute (string $route, callable $handler) : void
    {
        $this->routes->add(Route\Spec::create($route, $handler));
    }

    public function route ($path, $params)
    {
        $route = $this->routes->find($path);
        if ($route === null) {
            return null;
        }

        return call_user_func($route, $params);
    }
}
