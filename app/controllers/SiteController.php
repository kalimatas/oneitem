<?php

use \Site\Listing;

class SiteController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_LAYOUT);
        $this->view->setLayout('site');
        Phalcon\Tag::prependTitle('Site');
    }

    public function indexAction()
    {

    }

    /**
     * Получение листинга для сайта по категории
     */
    public function shopAction()
    {
        $categoryId = 1;
        $api_token = '3a0fbd7580b193300e808aa539f974c0';

        $listing = new Listing();
        $data = $listing->get($categoryId);
        $this->view->setVar('listing', $data);
        $this->view->setVar('api_token', $api_token);
    }
}