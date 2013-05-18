<?php

class OneController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('one');
        Phalcon\Tag::prependTitle('One');
    }

    /**
     * Про about
     */
    public function indexAction()
    {

    }

    /**
     *
     */
    public function aboutAction()
    {

    }

    /**
     * Регистрация
     */
    public function registerAction()
    {

    }

    /**
     * Авторизация
     */
    public function authAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new \One\User();
            $user = $userModel->login($email, $password);

            if ($user !== false) {
                $this->session->set('auth', array(
                                                 'id' => $user->id,
                                            )
                );
                switch ($user->group) {
                    case \One\User::GROUP_CLIENT:
                        $redirect = '/client';
                        break;
                    case \One\User::GROUP_PUBLISHER:
                        $redirect = '/publisher';
                        break;
                }
                echo json_encode(array(
                                      'status' => 'success',
                                      'redirect' => $redirect,
                                 )
                );
            } else {
                echo json_encode(array(
                                      'status' => 'fail',
                                      'msg' => 'Некорректно указаны email или пароль',
                                 )
                );
            }
        }
        die();
    }

    /**
     * Выход
     */
    public function logoutAction()
    {
        $this->session->destroy();

        $this->response->redirect('one');
    }

    /**
     * Редирект на форму магазина
     */
    public function newOrderAction()
    {

    }

    /**
     * Создание заказа по Email
     */
    public function newOrderEmailAction()
    {

    }
}