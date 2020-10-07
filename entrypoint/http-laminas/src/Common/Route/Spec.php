<?php

namespace SofiB\Delivery\Common\Route;

class Spec
{
    private $path;
    private function __construct (string $path, callable $handler)
    {
        $this->path = $path;
        $this->handler = $handler;
    }

    public static function create (string $path, callable $handler) : Spec
    {
        return new Spec($path, $handler);
    }

    public function path () : string
    {
        return $this->path;
    }

    public function handler () : callable
    {
        return $this->handler;
    }
}