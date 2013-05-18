<?php

namespace Shop;

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
}