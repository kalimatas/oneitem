<?php

use \Shop\Listing;
use \Phalcon\Mvc\View;
use \Shop\Order;

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
     * Создание заказа
     */
    public function newOrderAction()
    {
        $productList = $this->request->get('product_list');
        $name = $this->request->get('name');
        $mobile = $this->request->get('mobile');
        $address = $this->request->get('address');

        if (!$productList || !$name || !$mobile || !$address) {
            $this->response->redirect('/shop', true);
            return;
        }

        $orderData = array(
            'product_list' => $productList,
            'name' => $name,
            'mobile' => $mobile,
            'address' => $address,
        );

        $order = new Order();
        try {
            $order->createOrder($orderData);
            $this->flashSession->success('Заказ успешно создан! <br /><a href="/shop">Перейти на главную</a>');
        } catch (Exception $e) {
            $this->flashSession->error('Ошибка создания заказа!');
        }
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