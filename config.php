<?php

define('DS', DIRECTORY_SEPARATOR);
$sitePath = realpath(__DIR__) . DS;
define('SITE_PATH', $sitePath);

define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'test_db');