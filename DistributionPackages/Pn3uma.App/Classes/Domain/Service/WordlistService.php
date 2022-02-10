<?php
namespace Pn3uma\App\Domain\Service;

/*
 * This file is part of the Pn3uma.App package.
 */

use Neos\Flow\Annotations as Flow;

/**
 * Service for handle wordlists
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
    private function getPathToImportDir(): string
    {
        return FLOW_PATH_ROOT . 'DistributionPackages/Pn3uma.App/Resources/Private/Import/Wordlists';
    }

    /**
     * @return string
     */
    private function getPathToImportTargetDir(): string
    {
        return FLOW_PATH_DATA.'Wordlist';
    }

    /**
     * @param array $results
     * @param string $currentDir
     * @return array
     */
    public function getFilesToImport(array &$results = array(), string $currentDir = ''): array
    {
        $wordlistDir = $this->getPathToImportDir();
        $files = scandir($wordlistDir);

        foreach ($files as $key => $value) {
            $path = realpath($wordlistDir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if($currentDir == '') {
                    $results[$key]['name'] = $value;
                    $results[$key]['path'] = $path;
                } else {
                    $results[$currentDir][$key] = array('name' => $value, 'path' => $path);
                }
            } else if ($value != "." && $value != "..") {
                $currentDir = basename($path);
                $this->getFilesToImport( $results, $currentDir);
            }
        }
        return $results;
    }

    /**
     * @param array $files
     * @param bool $prune
     * @return boolean
     */
    public function importFiles(array $files, bool $prune = false): bool
    {
        $response = false;
        $targetImportDir = $this->getPathToImportTargetDir();

        if($prune) {
            $this->deleteDir($targetImportDir);
        }

        if (!file_exists($targetImportDir)) {
            mkdir($targetImportDir, 0777, true);
            $response = true;
        }

        return $response;
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
