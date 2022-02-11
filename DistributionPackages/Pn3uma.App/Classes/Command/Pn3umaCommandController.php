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
     * Import Wordlists
     */
    public function importWordlistCommand()
    {
        $response = null;

        while (!in_array($response, ['y', 'n'])) {
            $response = $this->output->ask('Remove already imported Wordlist? (y/n)');
        }

        $pruneImportedWordlist = false;
        if($response === 'y') {
            $pruneImportedWordlist = true;
        }

        $fileImport = $this->wordlistService->importFiles($pruneImportedWordlist);

        if($fileImport) {
            $this->outputLine('wordlist imported.');
        } else {
            $this->outputLine('Could not import wordlist');
        }
    }
}
