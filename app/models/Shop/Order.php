<?php

namespace Shop;

class Order extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('shop_order');
    }
}