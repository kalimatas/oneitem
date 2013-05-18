<?php

namespace Shop;

class Product extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('shop_product');
    }
}