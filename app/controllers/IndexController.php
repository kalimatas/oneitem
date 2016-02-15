<?php

class IndexController extends ControllerBase
{
    /**
     * Controller comment
     */
    public function indexAction()
    {
        $this->response->redirect('one');
    }
}
