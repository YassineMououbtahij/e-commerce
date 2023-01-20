<?php

namespace App\Core;

class Request
{
    public string $method;
    public string $path;
    public $params;

    public function __construct(string $method, string $path, $params)
    {
        $this->method = $method;
        $this->path = $path;
        $this->params = [
            "get" => $_GET,
            "post" => $_POST,
            "params" => $params
        ];
    }
}
