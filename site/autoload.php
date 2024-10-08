<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = __DIR__ . '/' . $className . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});