<?php

namespace App\Core;

use Exception;

class Router
{

    public $routes = [
        "get" => [],
        "post" => []
    ];

    public function get(string $path, array $func): void
    {
        $this->routes["get"][$path] = $func;
    }

    public function post(string $path, array $func): void
    {
        $this->routes["post"][$path] = $func;
    }

    public function extractUrlxParams(array $routes, string $path_info)
    {
        if ($path_info == "/") {
            return [$routes[$path_info], []];
        }

        $callback = null;
        $params = [];

        foreach ($routes as $route_url => $route_callback) {
            $pattern = $route_url;

            $pattern = str_replace("/", "\/", $pattern);
            $pattern = preg_replace("/\{[a-zA-Z]+\}/i", "[a-zA-Z0-9]+", $pattern);

            $pattern = "/^{$pattern}$/i";

            if (preg_match($pattern, $path_info)) {
                $callback = $route_callback;

                $route_url = substr($route_url, 1);
                $path_info = substr($path_info, 1);

                $url_pieces = explode("/", $route_url);
                $path_pieces = explode("/", $path_info);

                foreach ($url_pieces as $key => $url_piece) {
                    if (str_contains($url_piece, "{")) {
                        $url_piece = str_replace("{", "", $url_piece);
                        $url_piece = str_replace("}", "", $url_piece);

                        $params[$url_piece] = $path_pieces[$key];
                    }
                }

                break;
            }
        }
        return [$callback, $params];
    }

    public function resolve()
    {
        $path_info = $_SERVER["PATH_INFO"] ?? "/";
        $request_method = strtolower($_SERVER["REQUEST_METHOD"]);

        $routes = $this->routes[$request_method];

        [$callback, $params] = $this->extractUrlxParams($routes, $path_info);

            if ($callback) {

            new Database();

            $request = new Request($request_method, $path_info, $params);

            $callback[0] = new $callback[0]($request);

            call_user_func($callback);
        } else {
            echo include_once "../Resources/views/errors/4O4Page.php";
        }
    }
}
