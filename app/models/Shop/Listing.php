<?php

namespace Shop;

/**
 * Class Listing
 *
 * @package Shop
 */
class Listing
{
    /**
     * @return array
     */
    public function get()
    {
        $result = array();

        $categoryModel = new Category();
        $categoryList = $categoryModel->getList();
        foreach ($categoryList as $category) {
            /** @var \Shop\Category $category */
            $productList = $category->getProductList();

            $result[] = array(
                'category' => $category->toArray(),
                'product_list' => $productList->toArray(),
            );
        }

        return $result;
    }
}