<?php
namespace Pn3uma\App\Controller;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Flow\Mvc\View\ViewInterface;
use Neos\Flow\Mvc\Controller\ControllerContext;
use Neos\Flow\Security\Context;

abstract class AbstractBaseController extends ActionController
{
    /**
     * @Flow\Inject
     * @var Context
     */
    protected $securityContext;

    /**
     * @Flow\Inject
     * @var PersistenceManagerInterface
     */
    protected $persistenceManager;


    /**
     * Initializes the controller before invoking an action method.
     * @return void
     */
    protected function initializeAction() {

    }

    /**
     * @return void
     */
    protected function initializeView(ViewInterface $view) {

    }
}
