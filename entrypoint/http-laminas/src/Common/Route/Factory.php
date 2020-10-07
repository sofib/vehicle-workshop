<?php

namespace SofiB\Delivery\Common\Route;

// what did I want here....
class Factory
{
    private static $pattern = '/(^|\/)?(?<part>.*?)(\/|\?|$)/';
    public static function fromRequest ($matchPath)
    {
        $matches = (array) preg_match_all(static::$pattern, $_REQUEST['REQUEST_PATH']);
        $parts = array_column($matches, 'part');

        return $parts;
    }
}
