<?php

class Router
{
    public function start(): void
    {
        $this->getController($file, $controller, $action, $args);

        if (is_readable($file) === false) {
            die ('404 Not Found');
        }

        include_once $file;

        $controller = new $controller();

        if (is_callable([$controller, $action]) === false) {
            die ('404 Not Found');
        }

        $controller->$action($args);
    }

    private function getController(&$file, &$controller, &$action, &$args)
    {
        $parts = parse_url($this->getURI());
        parse_str($parts['query'] ?? '', $args);

        $path = explode('/', $parts['path']);
        $controller = array_shift($path);
        if (empty($controller)) {
            $controller = 'index';
        }

        $action = array_shift($path);
        if (empty($action)) {
            $action = 'index';
        }

        $controller = ucfirst($controller) . 'Controller';
        $action = $action . 'Action';

        $file = SITE_PATH . 'controllers' . DS . $controller . '.php';
    }

    private function getURI(): string
    {
        $route = $_SERVER['REQUEST_URI'];

        return trim($route, '/\\');
    }
}
