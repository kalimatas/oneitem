<?php

class User extends \Phalcon\Mvc\Model
{
    const GROUP_GUEST = 'guest';
    const GROUP_PUBLISHER = 'publisher';
    const GROUP_CLIENT = 'client';

    public $id;
    public $login;
    public $password;
    public $group;
    public $added;

    public function generatePassword($password = false)
    {
        return md5($password);
    }
}