<?php

spl_autoload_register(function (string $className) {
    $fileName = $className . '.php';
    $folders = [
        '/components/',
        '/controllers/',
        '/models/',
    ];

    foreach ($folders as $folder) {
        $file = SITE_PATH . $folder . DS . $fileName;

        if (is_file($file)) {
            include_once $file;
        }
    }
});
