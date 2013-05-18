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
        $jsonString = file_get_contents($this->url . '?category_id=' . $categoryId);
        if (!$jsonString) {
            return array();
        }

        $json = json_decode($jsonString, true);
        return $json;
    }
}