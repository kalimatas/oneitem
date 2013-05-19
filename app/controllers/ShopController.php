<?php

use \Shop\Listing;
use \Phalcon\Mvc\View;
use \Shop\Order;

class ShopController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('shop');
        Phalcon\Tag::prependTitle('Shop');
    }

    /**
     * Листинг
     */
    public function indexAction()
    {
        $category_id = $this->request->getQuery('category');

        $listing = new Listing();
        $this->view->setVar('listing', $listing->get($category_id));
    }

    /**
     * Создание заказа
     */
    public function newOrderAction()
    {
        $productList = $this->request->get('product_list');
        $name = '';
        $mobile = '';
        $address = '';

        if (!$productList) {
            $this->response->redirect('/shop', true);
            return;
        }

        $productModel = new \Shop\Product();
        $product = $productModel->findFirst('id = ' . (int)$productList[0]);

        if ($product == false) {
            $this->response->redirect('/shop', true);
            return;
        }

        if ($this->request->isPost()) {
            $name = $this->request->getPost('name');
            $mobile = $this->request->getPost('mobile');
            $address = $this->request->getPost('address');
            if (empty($name)) {
                $this->flashSession->error('Не указано имя');
            } elseif (empty($mobile)) {
                $this->flashSession->error('Не указан телефон');
            } elseif (empty($address)) {
                $this->flashSession->error('Не указан адрес');
            } else {
                $order = new \Shop\Order();
                try {
                    $data = array(
                        'product_id' => $product->id,
                        'name' => $name,
                        'mobile' => $mobile,
                        'address' => $address,
                        'price' => $product->price,
                        'added' => date('Y-m-d H:i:s'),
                    );
                    $order->save($data);

                    $this->flashSession->success('Заказ успешно создан');
                    $this->response->redirect('shop');
                    return;
                } catch (Exception $e) {
                    $this->flashSession->error('Ошибка создания заказа!');
                }
            }
        }

        $this->view->setVar('product', $product);
        $this->view->setVar('name', $name);
        $this->view->setVar('mobile', $mobile);
        $this->view->setVar('address', $address);
    }

    public function jsonAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $this->response->resetHeaders();
        $this->response->setHeader('Content-type', 'application/json; charset=utf-8');

        $listing = new Listing();
        echo json_encode($listing->getJson(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function statAction()
    {
        $order = new \Shop\Order();
        $orderList = $order->find(array('order' => 'added desc'));

        $this->view->setVar('orderList', $orderList);
    }
}