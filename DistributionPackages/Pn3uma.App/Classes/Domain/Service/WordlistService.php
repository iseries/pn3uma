<?php
namespace Pn3uma\App\Domain\Service;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;

/**
 * Service for handle Wordlist
 * @Flow\Scope("singleton")
 * @api
 */
class WordlistService
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
    public function getPathToImportDir(): string
    {
        return FLOW_PATH_ROOT . $this->settings['Wordlist']['pathToImportDir'];
    }

    /**
     * @return string
     */
    public function getPathToImportTargetDir(): string
    {
        return FLOW_PATH_DATA . 'Wordlist';
    }

    /**
     * @param string $wordlistDir
     * @param array $results
     * @param string $currentDir
     * @return array
     */
    public function getFileListFromDir(string $wordlistDir, array &$results = array(), string $currentDir = ''): array
    {
        $files = scandir($wordlistDir);

        foreach ($files as $key => $value) {
            $path = realpath($wordlistDir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if($currentDir !== '') {
                    $results[$currentDir][$key]['name'] = $value;
                    $results[$currentDir][$key]['path'] = $path;
                } else {
                    $results[$key]['name'] = $value;
                    $results[$key]['path'] = $path;
                }
            } else if ($value != "." && $value != "..") {
                $currentDir = basename($path);
                $this->getFileListFromDir($path, $results, $currentDir);
            }
        }
        return $results;
    }

    /**
     * @param bool $prune
     * @return boolean
     */
    public function importFiles(bool $prune = false): bool
    {
        $response = false;
        $sourceImportDir = $this->getPathToImportDir();
        $targetImportDir = $this->getPathToImportTargetDir();

        if($prune) {
            $this->deleteDir($targetImportDir);
        }

        if (!file_exists($targetImportDir)) {
            mkdir($targetImportDir, 0777, true);
        }

        return $this->moveDirsAndFiles($sourceImportDir, $targetImportDir);
    }

    /**
     * @param string $source
     * @param string $targetImportDir
     * @return boolean
     */
    private function moveDirsAndFiles(string $source, string $targetImportDir): bool
    {
        return rename($source, $targetImportDir);
    }

    /**
     * @param string $dirPath
     * @return boolean
     */
    private function deleteDir(string $dirPath): bool
    {
        if (! is_dir($dirPath)) {
            return false;
        }

        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);

        return true;
    }
}
