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

class ApiController extends AbstractBaseController
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
     * A list of IANA media types which are supported by this controller
     * @var array
     */
    protected $supportedMediaTypes = ['application/json'];


    /**
     * @param string $domain
     * @return boolean|string
     */
    public function getPortResponseAction(string $domain = '')
    {
        $result = $this->networkService->checkPort($domain);
        return json_encode($result);
    }

    /**
     * @param string $domain
     * @return boolean|string
     */
    public function getHttpResponseAction(string $domain = '')
    {
        $result = $this->networkService->checkHttpHeader($domain);
        return json_encode($result);
    }
}
