<?php
namespace Pn3uma\App\Controller;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Mvc\Exception\NoSuchArgumentException;
use Pn3uma\App\Controller\AbstractBaseController;
use Pn3uma\App\Domain\Service\DirsearchService;
use Pn3uma\App\Domain\Service\NetworkService;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends AbstractBaseController
{
    /**
     * @Flow\Inject
     * @var DirsearchService
     */
    protected $dirsearchService;

    /**
     * @Flow\Inject
     * @var NetworkService
     */
    protected $networkService;

    /**
     * @return void
     */
    public function indexAction()
    {

    }

    /**
     * @return void
     */
    public function wordlistsAction()
    {

    }

    /**
     * @return void
     */
    public function domainAction()
    {

    }

    /**
     * @return void
     * @throws NoSuchArgumentException
     */
    public function domainSearchAction()
    {
        if($this->request->hasArgument('domain')) {
            $domain = $this->request->getArgument('domain');
            $jsonResponse = $this->networkService->checkSubdomains($domain);
            $this->view->assign('domains', json_decode($jsonResponse));
        }
    }

    /**
     * @return void
     * @throws NoSuchArgumentException
     */
    public function domainWriteAction()
    {
        $response = 'No domain selected';
        $domainsFound = false;

        if($this->request->hasArgument('check_domain')) {
            $urls = $this->request->getArgument('check_domain');
            if(is_array($urls)) {
                $response = $this->dirsearchService->writeUrlsTxt($urls);
                $domainsFound = true;
            }
        }
        $this->view->assign('response', array('message' => $response, 'status' => $domainsFound));
    }
}
