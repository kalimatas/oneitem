<?php

class ClientController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('one');
        Phalcon\Tag::prependTitle('One : Client');
    }

    /**
     * Настройка клиента, если авторизован
     */
    public function indexAction()
    {

    }
}