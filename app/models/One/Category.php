<?php

namespace One;

class Category extends \Phalcon\Mvc\Model
{
    public $id;
    public $name;

    public function initialize()
    {
        $this->setSource('one_category');
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
        return \One\Product::find("category_id = " . $this->id);
    }
}