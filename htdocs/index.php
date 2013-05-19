<?php

define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('HTDOCS_DIR', __DIR__);

header('Content-type: text/html; charset=utf-8');

try {
    require_once ROOT_DIR . '/app/config/bootstrap.php';

    $di['router'] = function () {
        $router = new Phalcon\Mvc\Router();
        $router->add('/', array(
                               'controller' => 'index',
                               'action' => 'index'
                          ));
        $router->add('/:controller/:action/:params', array(
                                                          'controller' => 1,
                                                          'action' => 2,
                                                          'params' => 3,
                                                     )
        );
        return $router;
    };

    $di->set('session', function () {
        $session = new Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    $di['dispatcher'] = function () use ($di) {
        $security = new \Security();
        $security->setDI($di);
        $eventsManager = new Phalcon\Events\Manager();
        $eventsManager->attach('dispatch', $security);
        $eventsManager->attach('dispatch', function ($event, $dispatcher) {
            if ($event->getType() == 'beforeDispatchLoop') {
                $keyParams = array();
                $params = $dispatcher->getParams();
                foreach ($params as $number => $value) {
                    if ($number & 1) {
                        $keyParams[$params[$number - 1]] = $value;
                    }
                }
                $dispatcher->setParams($keyParams);
            }
        });

        $dispatcher = new Phalcon\MVc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    };

    $di->set('elements', function () {
        return new \Elements();
    });

    $di->set('flash', function() {
        return new \Phalcon\Flash\Session();
    });

    $di->set('view', function () use ($config) {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir($config->application->viewsDir);
        return $view;
    });

    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch (\Phalcon\Exception $e) {
    \Logger::get()->error('PhalconException: ' . $e->getMessage());
}