<?php

class App
{
    private $controller = 'Blog';
    private $method = 'index';

    private function splitURL(): array
    {
        $url = $_GET['url'] ?? 'Blog';
        return explode('/', trim($url, '/'));
    }

    public function loadController()
    {
        $URL = $this->splitURL();
        $filename = '../app/controllers/'.ucfirst($URL[0]).'.php';

        if (file_exists($filename))
        {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }else {
            $filename = '../app/controllers/ErrorController.php';
            require $filename;
            $this->controller = 'ErrorController';
        }

        $controller = new $this->controller;

        if (isset($URL[1]))
        {
            if(method_exists($controller, $URL[1]))
            {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);
    }
}