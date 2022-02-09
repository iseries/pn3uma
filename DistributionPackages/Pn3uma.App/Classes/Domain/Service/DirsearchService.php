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
     * @param $domains
     * @return void
     */
    public function writeUrlsTxt($domains) {
        // define variables
        $filePath = $this->settings['dirsearch']['fileToSaveUrlsPath'];
        $fileName = $this->settings['dirsearch']['fileToSaveUrlsName'];
        $file = $filePath.$fileName;

        // collect domains
        foreach($domains as $domain) {
            $domains .= $domain.PHP_EOL;
        }

        // try to write the txt file
        if (is_writable($file)) {
            if (!$fp = fopen($file, 'w')) {
                echo "Cannot open file ($fileName)";
                exit;
            }

            if (fwrite($fp, $domains) === FALSE) {
                echo "Cannot write to file ($fileName)";
                exit;
            }

            echo "Success";

            fclose($fp);
        } else {
            echo "The file $fileName is not writable";
        }
    }
}
