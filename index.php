<?php

error_reporting(E_ALL);

session_start();

include ('config.php');
include (SITE_PATH . 'components' . DS . 'Autoload.php');

$router = new Router();
$router->start();
