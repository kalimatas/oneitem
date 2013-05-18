<?php

namespace One;

class User extends \Phalcon\Mvc\Model
{
    const GROUP_GUEST = 'guest';
    const GROUP_PUBLISHER = 'publisher';
    const GROUP_CLIENT = 'client';

    public $id;
    public $email;
    public $password;
    public $group;
    public $api_token;
    public $added;

    public function generatePassword($password = false)
    {
        return md5($password);
    }
}