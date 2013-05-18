<?php

use \Shop\Listing;

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
}