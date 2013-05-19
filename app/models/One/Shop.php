<?php

namespace One;

class Shop extends \Phalcon\Mvc\Model
{
    const ORDER_MODE_ONE = 'one';
    const ORDER_MODE_EMAIL = 'email';

    public $id;
    public $user_id;
    public $name;
    public $url;
    public $order_mode;
    public $order_url;
    public $json_url;

    public function initialize()
    {
        $this->setSource('one_shop');
    }
}