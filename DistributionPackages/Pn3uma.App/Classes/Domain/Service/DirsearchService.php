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
    public function writeUrlsTxt() {
        if($_POST) {
            if(array_key_exists('check_domain', $_POST)) {
                $domains = '';
                foreach($_POST['check_domain'] as $domain) {
                    $domains .= $domain.PHP_EOL;
                }

                var_dump($domains);

                $filename = '/var/www/tools.local/files/urls.txt';
                if (is_writable($filename)) {
                    if (!$fp = fopen($filename, 'w')) {
                        echo "Cannot open file ($filename)";
                        exit;
                    }

                    if (fwrite($fp, $domains) === FALSE) {
                        echo "Cannot write to file ($filename)";
                        exit;
                    }

                    echo "Success";

                    fclose($fp);
                } else {
                    echo "The file $filename is not writable";
                }
            }
        }
    }
}
