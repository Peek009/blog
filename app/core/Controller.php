<?php

class Controller
{
    public function view(string $name, array $data = null)
    {
        if (isset($data)) {
            extract($data);
        }

        $filename = '../app/views/'.$name.'.view.phtml';

        if (file_exists($filename)) {
            require $filename;
        }else {
            $filename = '../app/views/404.view.phtml';
            require $filename;
        }
    }
}