#!/usr/bin/php
<?php

define('ROOT_DIR', realpath(__DIR__ . '/..'));

chdir(dirname(__DIR__));

try {
    require_once ROOT_DIR . '/app/config/bootstrap.php';

    $di->setShared('router', function () {
        return new \Phalcon\CLI\Router();
    });

    $di->setShared('dispatcher', function () {
        return new \Phalcon\CLI\Dispatcher();
    });

    $app = new \Phalcon\CLI\Console();
    $app->setDI($di);
    $app->handle($argv);

} catch (\Phalcon\Exception $e) {
    echo "Exception: ", $e->getMessage();
}