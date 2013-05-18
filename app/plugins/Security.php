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
            /** @var $user \One\User */
            $user = \One\User::findFirst(array(
                                         'id = :id:',
                                         'bind' => array(
                                             'id' => $auth['id'],
                                         )
                                    ));
            if ($user) {
                \Logger::get()->info('user logged : ' . $user->login);
                $di = $this->getDI();
                $di->set('user', $user);

                if ($user->group == \One\User::GROUP_CLIENT) {
                    $role = \One\User::GROUP_CLIENT;
                } elseif ($user->group == \One\User::GROUP_PUBLISHER) {
                    $role = \One\User::GROUP_PUBLISHER;
                } else {
                    $role = \One\User::GROUP_GUEST;
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
            \One\User::GROUP_CLIENT => new Phalcon\Acl\Role(\One\User::GROUP_CLIENT),
            \One\User::GROUP_PUBLISHER => new Phalcon\Acl\Role(\One\User::GROUP_PUBLISHER),
            \One\User::GROUP_GUEST => new Phalcon\Acl\Role(\One\User::GROUP_GUEST),
        );
        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        return $acl;
    }
}