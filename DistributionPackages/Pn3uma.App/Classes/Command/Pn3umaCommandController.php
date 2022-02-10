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
use Pn3uma\App\Domain\Service\WordlistService;

class Pn3umaCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var WordlistService
     */
    protected $wordlistService;

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
    public function importWordlistsCommand()
    {
        $response = null;

        while (!in_array($response, ['y', 'n'])) {
            $response = $this->output->ask('Remove already imported wordlists? (y/n)');
        }

        $pruneImportedWordlists = false;
        switch ($response) {
            case 'y':
                $pruneImportedWordlists = true;
            default:
        }

        $files = $this->wordlistService->getFilesToImport();

        \Neos\Flow\var_dump($pruneImportedWordlists);

    }
}
