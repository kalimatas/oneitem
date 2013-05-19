<?php

namespace One;

class Order extends \Phalcon\Mvc\Model
{
    public $id;
    public $site_id;
    public $shop_id;
    public $product_id;
    public $price;
    public $name;
    public $mobile;
    public $address;
    public $added;

    public function initialize()
    {
        $this->setSource('one_order');
        $this->belongsTo('product_id', '\One\Product', 'id');
    }

    public function getProduct()
    {
        return $this->getRelated('\One\Product');
    }
}