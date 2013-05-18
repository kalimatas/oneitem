<?php

use \Phalcon\Mvc\View;
use \Publisher\Listing;

class PublisherController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('one');
        Phalcon\Tag::prependTitle('One : Publisher');
    }

    /**
     * Настройка pusher'а, если авторизован
     */
    public function indexAction()
    {

    }

    /**
     * Листинг товаров
     */
    public function listingAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $this->response->resetHeaders();
        $this->response->setHeader('Content-type', 'application/json');

        $categoryId = $this->request->get('category_id');

        $listing = new Listing();
        echo json_encode($listing->getJson($categoryId), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}