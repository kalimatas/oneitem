<?php

namespace One;

class Product extends \Phalcon\Mvc\Model
{
    public $id;
    public $site_id;
    public $site_product_id;
    public $status;
    public $category_id;
    public $name;
    public $description;
    public $price;

    public function initialize()
    {
        $this->setSource('one_product');
        $this->belongsTo('shop_id', '\One\Shop', 'id');
    }

    public function getShop()
    {
        return $this->getRelated('\One\Shop');
    }
}