<?php
namespace Pn3uma\App\Domain\Service;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;

/**
 * The dirsearch service provides the logic to interact with the dirsearch command-line tool.
 * @Flow\Scope("singleton")
 * @api
 */
class DirsearchService
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
     * @param array $domains
     * @return string
     */
    public function writeUrlsTxt(array $domains): string
    {
        // define variables
        $filePath = $this->settings['dirsearch']['fileToSaveUrlsPath'];
        $fileName = $this->settings['dirsearch']['fileToSaveUrlsName'];
        $file = $filePath.$fileName;

        // collect domains
        $domainToWrite = '';
        foreach($domains as $domain) {
            $domainToWrite .= $domain.PHP_EOL;
        }

        // try to write the txt file
        if (is_writable($file)) {
            if (!$fp = fopen($file, 'w')) {
                return 'Cannot open file ('.$fileName.').';
            }

            if (fwrite($fp, $domainToWrite) === FALSE) {
                return 'Cannot write to file ('.$fileName.').';
            }

            fclose($fp);
            return 'The file ('.$fileName.') was updated successfully.';
        } else {
            return 'The file ('.$fileName.') is not writable.';
        }
    }
}
