<?php
define('DB_CONN', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'phptest');
define('DB_USER', 'root');
define('DB_PASS', '');


/**
* To autoload all class used
*/
spl_autoload_register( function ($className) {
    require $className.'.php';
 });