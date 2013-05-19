<?php

namespace One;

class Site extends \Phalcon\Mvc\Model
{
    public $id;
    public $user_id;
    public $name;
    public $url;
    public $api_token;

    public function initialize()
    {
        $this->setSource('one_site');
    }
}
