<?php

use \Phalcon\Events\Event;
use \Phalcon\Mvc\Dispatcher;

class Security extends Phalcon\Mvc\User\Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        $role = 'guest';
        if ($auth) {
            /** @var $user \User */
            $user = User::findFirst(array(
                                         'id = :id:',
                                         'bind' => array(
                                             'id' => $auth['id'],
                                         )
                                    ));
            if ($user) {
                \Logger::get()->info('user logged : ' . $user->login);
                $di = $this->getDI();
                $di->set('user', $user);

                if ($user->group == \User::GROUP_CLIENT) {
                    $role = \User::GROUP_CLIENT;
                } elseif ($user->group == \User::GROUP_PUBLISHER) {
                    $role = \User::GROUP_PUBLISHER;
                } else {
                    $role = \User::GROUP_GUEST;
                }
            } else {
                \Logger::get()->info('not found logged : ' . $user->login);

                $this->session->destroy();
                $this->session->remove('auth');
            }
        } else {
            \Logger::get()->info('not logged');
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != Phalcon\Acl::ALLOW) {
            $dispatcher->forward(
                array(
                     'controller' => 'index',
                     'action' => 'index'
                )
            );

            return false;
        }
    }

    protected function getAcl()
    {
        $acl = new Phalcon\Acl\Adapter\Memory();

        $roles = array(
            \User::GROUP_CLIENT => new Phalcon\Acl\Role(\User::GROUP_CLIENT),
            \User::GROUP_PUBLISHER => new Phalcon\Acl\Role(\User::GROUP_PUBLISHER),
            \User::GROUP_GUEST => new Phalcon\Acl\Role(\User::GROUP_GUEST),
        );
        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        return $acl;
    }
}