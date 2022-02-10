<?php
namespace Pn3uma\App\Domain\Service;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;
use SleekDB\Store;

/**
 * pn3uma is using seekDB for saving data - https://sleekdb.github.io
 * @Flow\Scope("singleton")
 * @api
 */
class DatabaseService
{

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
     * @return string
     */
    private function getDatabasePath(): string
    {
        return FLOW_PATH_DATA . $this->settings['sleekDB']['database'];
    }

    /**
     * @param string $storeName
     * @return mixed
     */
    public function getStore($storeName): bool
    {
        return new Store($storeName, $this->getDatabasePath());
    }

    /**
     * @param Store $store
     * @return mixed
     * @throws \SleekDB\Exceptions\IOException
     */
    public function deleteStore($store): bool
    {
        $store->deleteStore();
    }
}
