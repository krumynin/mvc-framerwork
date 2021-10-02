<?php

class Template
{
    private string $controller;
    private string $layouts = 'main_layout';

    public function __construct(string $controller)
    {
        $this->controller = strtolower(str_replace('Controller', '', $controller));
    }

    public function renderView(string $name, array $vars = []): void
    {
        $pathLayout = SITE_PATH . 'views' . DS . $this->layouts . '.php';
        $contentPage = SITE_PATH . 'views' . DS . $this->controller . DS . $name . '.php';

        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        include ($pathLayout);
    }
}
