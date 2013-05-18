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

    /**
     * @param int $categoryId
     * @return array
     */
    public function getJson($categoryId = null)
    {
        $result = array(
            'category_list' => array(),
            'product_list' => array(),
        );

        $categoryModel = new Category();
        $categoryList = $categoryModel->getList($categoryId);
        foreach ($categoryList as $category) {
            /** @var \Shop\Category $category */
            $result['category_list'][] = array(
                'id' => (int)$category->id,
                'name' => $category->name,
            );

            foreach ($category->getProductList() as $product) {
                $result['product_list'][] = array(
                    'id' => (int)$product->id,
                    'category_id' => (int)$product->category_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => (double)$product->price,
                );
            }
        }

        return $result;
    }
}