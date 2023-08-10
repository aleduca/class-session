<?php

namespace core\library;

use Exception;

class Route
{
    public static function resolve(array $routes)
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

        $request_method = $_SERVER['REQUEST_METHOD'];

        if (!array_key_exists($request_method, $routes)) {
            throw new Exception("Request Method {$request_method} does not exist in routes file");
        }

        $path = $routes[$request_method][$uri] ?? redirect('/404');

        path_or_include($path);
    }
}
