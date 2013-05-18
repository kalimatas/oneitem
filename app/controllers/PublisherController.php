<?php

class PublisherController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('one');
        Phalcon\Tag::prependTitle('One : Publisher');
    }

    /**
     * Настройка pusher'а, если авторизован
     */
    public function indexAction()
    {

    }

    /**
     * Листинг товаров
     */
    public function listingAction()
    {

    }
}