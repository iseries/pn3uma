<?php
namespace Pn3uma\App\Domain\Service;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;

/**
 * The network service provides logic for getting network stuff
 * @Flow\Scope("singleton")
 * @api
 */
class NetworkService
{
    const NO_DOMAIN_GIVEN = false;
    const DOMAIN_GIVEN = true;

    /**
     * @var array
     */
    protected $settings;

    /**
     * Inject the settings
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }

    /**
     * check port
     * @param string $domain
     * @return array
     */
    public function checkPort(string $domain = ''): array
    {
        $status = NetworkService::NO_DOMAIN_GIVEN;
        $response = 'error';

        if($domain) {
            $host = trim(str_replace('https://', '', $domain));
            $port = $this->settings['network']['port'];
            $response = 'Port '.$port.' is closed';

            $connection = @fsockopen($host, $port);
            if (is_resource($connection)) {
                $status = NetworkService::DOMAIN_GIVEN;
                $response = 'Port '.$port.' is open';
                fclose($connection);
            }
        }

        return array(
            'status' => $status,
            'response' => $response
        );
    }

    /**
     * check http header
     * @param string $domain
     * @return array
     */
    public function checkHttpHeader(string $domain = ''): array
    {
        $status = NetworkService::NO_DOMAIN_GIVEN;
        $response = 'error';

        if($domain !== '') {
            $response = 'not reachable';

            $domainHeaders = @get_headers($domain);
            if(is_array($domainHeaders)) {
                $status = NetworkService::DOMAIN_GIVEN;
                $response = $domainHeaders;
            }
        }

        return array(
            'status' => $status,
            'response' => $response
        );
    }
}
