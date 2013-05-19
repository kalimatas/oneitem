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
        $orderModel = new \One\Order();
        $orderList = $orderModel->find(array('order' => 'added desc'));

        $sum = 0;
        foreach ($orderList as $order) {
            $sum += $order->price;
        }
        $balance = 0;
        if ($sum) {
            $balance = $sum / 100 * 15;
        }

        $this->view->setVar('orderList', $orderList);
        $this->view->setVar('balance', $balance);
    }
}