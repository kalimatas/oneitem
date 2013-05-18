<?php

use \Shop\Listing;
use \Phalcon\Mvc\View;

class ShopController extends ControllerBase
{
    /**
     * Листинг
     */
    public function indexAction()
    {
        $listing = new Listing();
        $this->view->setVar('listing', $listing->get());
    }

    /**
     * Создание заказа "у себя"
     */
    public function newOrderAction()
    {

    }

    /**
     * API для создания заказа
     */
    public function newOrderApiAction()
    {

    }

    public function jsonAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $this->response->resetHeaders();
        $this->response->setHeader('Content-type', 'application/json');

        $listing = new Listing();
        echo json_encode($listing->getJson(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}