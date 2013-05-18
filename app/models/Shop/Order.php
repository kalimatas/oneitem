<?php

namespace Shop;
use Phalcon\Exception;

class Order extends \Phalcon\Mvc\Model
{
    public $id;
    public $product_id;
    public $price;
    public $name;
    public $mobile;
    public $address;
    public $added;

    public function initialize()
    {
        $this->setSource('shop_order');
    }

    /**
     * @param array $orderData
     * @throws \Phalcon\Exception
     */
    public function createOrder(array $orderData)
    {
        if (!count($orderData)) {
            throw new Exception('Нет данных.');
        }

        // сейчас только один товар
        $productId = (int)array_pop($orderData['product_list']);
        // получаем его цену
        $product = \Shop\Product::findFirst('id = ' . $productId);
        if (!$product) {
            throw new Exception('Нет товара.');
        }

        $data = array(
            'product_id' => $productId,
            'name' => $orderData['name'],
            'mobile' => $orderData['mobile'],
            'address' => $orderData['address'],
            'price' => $product->price,
            'added' => date('Y-m-d H:i:s'),
        );

        $this->save($data);
    }
}