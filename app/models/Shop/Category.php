<?php

namespace Shop;

class Category extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('shop_category');
    }
}