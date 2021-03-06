<?php

use \Phalcon\Mvc\View;

class PublisherController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('one');
        Phalcon\Tag::prependTitle('One : Publisher');
    }

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
            $balance = $sum / 100 * 10;
        }

        $this->view->setVar('orderList', $orderList);
        $this->view->setVar('balance', $balance);
    }

    /**
     * Листинг товаров
     */
    public function listingAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $this->response->resetHeaders();
        $this->response->setHeader('Content-type', 'application/json; charset=utf-8');

        $categoryId = $this->request->get('category_id');

        $listing = new \One\Listing();
        echo json_encode($listing->getJson($categoryId), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}