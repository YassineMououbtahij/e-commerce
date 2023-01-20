<?php

namespace App\Core;

use App\Core\Router;

class Application
{

    public static $config;

    public function __construct($config)
    {
        Application::$config = $config;
        $this->router = new Router();
    }

    /**
     * This function is a wrapper to $this->router->get();
     * 
     * @param string $path means the url path
     * @param array $func means the function to execute
     *
     * @return void 
     */
    public function get(string $path, array $func): void
    {
        $this->router->get($path, $func);
    }

    /**
     * This function is a wrapper to $this->router->post();
     * 
     * @param string $path means the url path
     * @param array $func means the function to execute
     *
     * @return void 
     */
    public function post(string $path, array $func): void
    {
        $this->router->post($path, $func);
    }

    public function run()
    {
        $this->router->resolve();
    }
}
