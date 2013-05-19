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

    public function initialize()
    {
        $this->setSource('one_user');
    }

    public function generatePassword($password = false)
    {
        return md5($password);
    }

    public function login($email, $password)
    {
        /** @var $user \One\User */
        $user = \One\User::findFirst(array(
                                     'email = :email: AND password = :password:',
                                     'bind' => array(
                                         'email' => $email,
                                         'password' => $this->generatePassword($password)
                                     )
                                )
        );
        if ($user) {
            \Logger::get()->info('login success');
            return $user;
        } else {
            \Logger::get()->info('login fail');
            return false;
        }
    }
}