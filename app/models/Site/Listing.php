<?php

namespace Site;

class Listing
{
    protected $url = 'http://one.dev/publisher/listing/';

    /**
     * @param int $categoryId
     * @return array
     */
    public function get($categoryId)
    {
        $result = array();

        $jsonString = file_get_contents($this->url . '?category_id=' . $categoryId);
        if (!$jsonString) {
            return $result;
        }

        $json = json_decode($jsonString, true);
        $result[] = array(
            'category' => $json['category_list'][0],
            'product_list' => $json['product_list'],
        );

        return $result;
    }
}