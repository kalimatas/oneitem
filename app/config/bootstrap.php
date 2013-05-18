<?php

umask(002);
error_reporting(E_ALL ^ E_WARNING);

$di = new \Phalcon\DI\FactoryDefault();

$config = new Phalcon\Config(require_once ROOT_DIR . '/app/config/config.php');
$di->set('config', $config);

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
         ROOT_DIR . $config->application->libraryDir,
         ROOT_DIR . $config->application->modelsDir,
         ROOT_DIR . $config->application->pluginsDir,
         ROOT_DIR . $config->application->tasksDir,
         ROOT_DIR . $config->application->controllersDir,
    )
)->register();
$di->set('loader', $loader);

$db = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                                             'host' => $config->database->host,
                                             'username' => $config->database->username,
                                             'password' => $config->database->password,
                                             'dbname' => $config->database->dbname,
                                             'charset' => 'utf8',
                                        ));
$eventsManager = new Phalcon\Events\Manager();
$logger = new \Phalcon\Logger\Adapter\File($di->get('config')->logs->sql);
$eventsManager->attach('db', function ($event, $db) use ($logger) {
    if ($event->getType() == 'beforeQuery') {
        $logger->log($db->getSQLStatement(), \Phalcon\Logger::INFO);
    }
});
$db->setEventsManager($eventsManager);
$di->set('db', $db);
