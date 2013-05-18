<?php

use \Site\Listing;

class SiteController extends ControllerBase
{
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