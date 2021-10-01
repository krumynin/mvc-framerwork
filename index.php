<?php

error_reporting(E_ALL);

include ('config.php');
include (SITE_PATH . 'components' . DS . 'Autoload.php');

$router = new Router();
$router->start();
