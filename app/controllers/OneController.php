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
        $this->indexAction();
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
        $apiToken = $this->request->get('api_token');
        $productList = $this->request->get('product_list');
        $name = '';
        $mobile = '';
        $address = '';

        if (!$productList) {
            $this->flashSession->error('Товар не найден');
        }
        $productModel = new \One\Product();
        $product = $productModel->findFirst('id = ' . (int)$productList[0]);
        if ($product == false) {
            $this->flashSession->error('Товар не найден');
        }

        if (!$apiToken && preg_match('~[0-9a-f]{32}~i', $apiToken)) {
            $this->flashSession->error('Неизвестный источник заказа');
        }
        $siteModel = new \One\Site();
        $site = $siteModel->findFirst('api_token = "' . $apiToken . '"');
        if (!$site) {
            $this->flashSession->error('Неизвестный источник заказа');
        }

        if ($this->request->isPost()) {
            $name = $this->request->getPost('name');
            $mobile = $this->request->getPost('mobile');
            $address = $this->request->getPost('address');
            if (empty($name)) {
                $this->flashSession->error('Не указано имя');
            } elseif (empty($mobile)) {
                $this->flashSession->error('Не указан телефон');
            } elseif (empty($address)) {
                $this->flashSession->error('Не указан адрес');
            } else {
                $order = new \One\Order();
                try {
                    $data = array(
                        'site_id' => $site->id,
                        'shop_id' => $product->shop_id,
                        'product_id' => $product->id,
                        'name' => $name,
                        'mobile' => $mobile,
                        'address' => $address,
                        'price' => $product->price,
                        'added' => date('Y-m-d H:i:s'),
                    );
                    $order->save($data);

                    $data = array(
                        'product_list[]' => $product->shop_product_id,
                        'name' => $name,
                        'mobile' => $mobile,
                        'address' => $address,
                        'price' => $product->price,
                    );

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'http://' . $this->getDI()->get('config')->host . $product->getShop()->order_url);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HEADER, 0);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
                    $data = curl_exec($curl);
                    if (!curl_errno($curl)) {
                        $info = curl_getinfo($curl);
                    }
                    curl_close($curl);


                    $this->flashSession->success('Заказ успешно создан');
                    $this->response->redirect('one/end');
                } catch (Exception $e) {
                    $this->flashSession->error('Ошибка создания заказа!');
                }
            }
        }

        $this->view->setVar('product', $product);
        $this->view->setVar('name', $name);
        $this->view->setVar('mobile', $mobile);
        $this->view->setVar('address', $address);
    }

    public function endAction()
    {

    }
}