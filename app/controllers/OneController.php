<?php

class OneController extends ControllerBase
{
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
                echo json_encode(array(
                                      'status' => 'success',
                                      'redirect' => '',
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

        $this->response->redirect();
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