<?php
namespace Pn3uma\App\Command;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Package\PackageManager;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Flow\Cli\ConsoleOutput;
use Neos\Flow\Cli\Request;
use Neos\Flow\Cli\Response;
use Neos\Flow\Persistence\PersistenceManagerInterface as PersistenceManagerInterface;
use Neos\Flow\Mvc\Routing\ObjectPathMappingRepository as ObjectPathMappingRepository;

class Pn3umaCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * @Flow\Inject
     * @var ConsoleOutput
     */
    protected $consoleOutput;

    /**
     * Import wordlists
     */
    public function importWordlists()
    {
        $response = null;
        while (!in_array($response, ['y', 'n'])) {
            $response = $this->output->ask('Remove already imported wordlists? (y/n/c)');
        }
        // handle the response
        switch ($response) {
            case 'y':
                // do something
            case 'n':
                // do something
        }
    }
}
