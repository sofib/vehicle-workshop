<?php

namespace SofiB\Delivery\Common\Route;

class Set implements \IteratorAggregate
{
    private $routes = [];
    
    public function add (Spec $route) : void
    {
        $this->routes[$route->path()] = $route;
    }

    public function has (string $path) : boolean
    {
        return array_key_exists($path, $this->routes);
    }

    public function getIterator () : Traversible
    {
        return new \ArrayIterator($this->routes);
    }

    public function find () : Spec
    {
      $found = null;
      foreach ($this->routes as $route) {
          if ($route->path() === $path) {
              $found = $route;
              break;
          }
      }
      return $found;
    }

    public function create () : Set
    {
        return new Set();
    }
}
