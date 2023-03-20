<?php

const APP_NAME = 'Blog';
const APP_DESC = 'Blog';
const DEBUG = true;

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define('DBNAME', 'blog');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', 'http://localhost/check/public');
}