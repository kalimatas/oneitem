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

    public function aboutAction()
    {

    }

    /**
     * Получение листинга для сайта по категории
     */
    public function listingAction()
    {
        $categoryId = 1;

        $listing = new Listing();
        $this->view->setVar('listing', $listing->get($categoryId));
    }
}