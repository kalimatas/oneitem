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
     * @param int $categoryId
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getList($categoryId = null)
    {
        if ($categoryId) {
            return $this->find('id = ' . $categoryId);
        } else {
            return $this->find();
        }
    }

    /**
     * @return \Phalcon\Mvc\Model\Resultset\Simple
     */
    public function getProductList()
    {
        return \Shop\Product::find("category_id = " . $this->id);
    }
}