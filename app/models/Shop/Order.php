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
        $this->belongsTo('product_id', '\Shop\Product', 'id');
    }

    public function getProduct()
    {
        return $this->getRelated('\Shop\Product');
    }
}