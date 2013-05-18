<?php

namespace Shop;

class Category extends \Phalcon\Mvc\Model
{
    public $id;
    public $name;

    public function initialize()
    {
        $this->setSource('shop_category');
    }
}