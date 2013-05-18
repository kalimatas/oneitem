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

    /**
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getList()
    {
        return $this->find();
    }

    /**
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getProductList()
    {
        return \Shop\Product::find("category_id = " . $this->id);
    }
}