<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

function redirect($path, array $data = null)
{
    if (isset($data))
    {
        $keys = array_keys($data);
        $string = 'Location: ' . ROOT.'/'.$path;
        foreach ($keys as $key)
        {
            show($key);
            $string .= '?'. $key . '=' . $data[$key];
        }
        header($string);
        die;
    }

    header('Location: ' . ROOT.'/'.$path);
    die;
}