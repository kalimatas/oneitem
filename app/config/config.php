<?php

umask(002);
date_default_timezone_set('Europe/Moscow');

define('LOGUS', 'general');
define('LOGUS_SQL', 'sql');

// Added some comment here

return array(
    'database' => array(
        'adapter' => 'mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'one',
    ),
    'application' => array(
        'controllersDir' => '/app/controllers/',
        'modelsDir' => '/app/models/',
        'viewsDir' => '../app/views/',
        'libraryDir' => '/library/',
        'tasksDir' => '/app/tasks/',
        'pluginsDir' => '/app/plugins/',
        'baseUri' => '',
    ),
    'logs' => array(
        LOGUS => ROOT_DIR . '/logs/general.log',
        LOGUS_SQL => ROOT_DIR . '/logs/sql.log'
    ),
    'host' => 'one.dev',
);
