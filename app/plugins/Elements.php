<?php

class Elements extends Phalcon\Mvc\User\Component
{
    public function getLogin()
    {
        $auth = $this->session->get('auth');
        if ($auth) {
            $user = $this->getDI()->get('user');

            var_dump($user);
        } else {
            //
        }
    }
}