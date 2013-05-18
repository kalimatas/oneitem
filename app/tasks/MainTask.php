<?php

class MainTask extends \Phalcon\CLI\Task
{
    public function mainAction()
    {
        $jsonUrl = 'http://one.dev/shop/json';
        $jsonString = file_get_contents($jsonUrl);

        if (!$jsonString) {
            return;
        }

        $values = array();
        $productList = json_decode($jsonString, true);
        foreach ($productList['product_list'] as $product) {
            $value = "(1, {$product['id']}, {$product['category_id']}, '{$product['name']}', '{$product['description']}', {$product['price']})";
            $values[] = $value;
        }

        $insertQuery = "
            INSERT INTO one_shop_product
                (shop_id, shop_product_id, category_id, name, description, price)
            VALUES
                " . implode(",\n", $values) . "
            ON DUPLICATE KEY UPDATE
                category_id = VALUES(category_id),
                name = VALUES(name),
                description = VALUES(description),
                price = VALUES(price)
        ";

        $db = $this->getDI()->get('db');
        $db->execute($insertQuery);
    }
}