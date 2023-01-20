<?php

namespace App\Core;

use App\Core\Application;

class Controller
{

    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(string $path, $params = [])
    {
        extract($params);

        ob_start();
        include_once Application::$config["ROOT_DIR"] . "/Resources/views/" . $path . ".php";
        $data = ob_get_contents();

        ob_end_clean();


        $pattern = '/\$\{.+\}\$/';

        if (preg_match($pattern, $data, $matches)) {
            ob_start();

            $path = $matches[0];
            $path = str_replace('${', "", $path);
            $path = str_replace('}$', "", $path);
            include_once Application::$config["ROOT_DIR"] . "/Resources/views/" . $path . ".php";
            $layout = ob_get_contents();

            $data = str_replace($matches[0], "", $data);
            $data = str_replace("{content}", $data, $layout);

            ob_end_clean();
        }

        echo $data;
    }
}
