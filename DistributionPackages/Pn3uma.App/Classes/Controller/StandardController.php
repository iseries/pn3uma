<?php
namespace Pn3uma\App\Controller;

/*
 * This file is part of the Pn3uma.App package.
 */
use Pn3uma\App\Controller\AbstractBaseController;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends AbstractBaseController
{
    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }
}
