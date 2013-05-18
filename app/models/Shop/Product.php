<?php

namespace Shop;

class Product extends \Phalcon\Mvc\Model
{
    public $id;
    public $status;
    public $category_id;
    public $name;
    public $description;
    public $price;

    public function initialize()
    {
        $this->setSource('shop_product');
    }
}