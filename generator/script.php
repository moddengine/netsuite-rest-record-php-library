<?php

use NetSuiteRestAPI\Loader;
use NetSuiteRestAPI\NetsuiteException;

include_once('./RecordDefinitionsParser.php');
include_once('./RecordSchemaParser.php');
include_once('./PHPGenerator.php');
include_once('./base/Config.php');
include_once('./base/Loader.php');

(new Index())->run();

/**
 * Main script to generate the library
 */
class Index
{
    /**
     * @var array
     */
    private $_config = [];

    /**
     * Index constructor
     */
    public function __construct()
    {
        $this->_config = (new Loader())->getConfig();
    }

    /**
     * @throws NetsuiteException
     */
    public function run()
    {
        echo "Starting...\n";

        echo sprintf("[1/4] Loading %s...\n", $this->getVersion());
        libxml_use_internal_errors(true);
        $baseDirectory = $this->_prepareBaseDirectory();
        $source = $this->_loadSource();
        $domDoc = new DOMDocument();
        $domDoc->loadHTML($source);
        $domXPath = new DOMXPath($domDoc);

        echo sprintf("[2/4] Loading Record Definitions...\n");
        $recordDefinitionsParser = new RecordDefinitionsParser($domXPath);

        echo sprintf("[3/4] Loading Record Schema...\n");
        $recordSchemaParser = new RecordSchemaParser($domXPath);

        echo sprintf("[4/4] Generating php classes...\n");
        (new PHPGenerator($baseDirectory))->run(
            $recordDefinitionsParser, $recordSchemaParser
        );

        echo "Finished.\n";
    }

    /**
     * @return bool|string
     */
    private function _loadSource()
    {
        $fileName = $this->getVersion() . '.html';
        if (!file_exists($fileName)) {
            echo "\t...from web\n";
            $source = file_get_contents($this->_config->apiSource);
            file_put_contents($fileName, $source);
        } else {
            echo "\t...from local\n";
            $source = file_get_contents($fileName);
        }

        return $source;
    }

    /**
     * @return string
     */
    private function _prepareBaseDirectory()
    {
        $baseDirectory = '../library';
        if (file_exists($baseDirectory)) {
            echo "\tRemoving old Base dir $baseDirectory\n";
            $this->_deleteDirectory($baseDirectory);
        }
        `cp -r base/ $baseDirectory/`;
        echo "\tCreated Base dir $baseDirectory\n";
        file_put_contents("$baseDirectory/version", $this->getVersion() . PHP_EOL);

        return $baseDirectory . '/';
    }

    /**
     * @param string $dir
     * @return bool
     */
    private function _deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->_deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        preg_match(
            '@REST_API_Browser\/record\/(v[\d\.]+)\/([\d\.]+)\/@',
            $this->_config->apiSource,
            $matches
        );

        return sprintf('%s-%s', $matches[1], $matches[2]);
    }

    /**
     * @param DOMXPath $domXPath
     * @param string $path
     * @param DOMNode $contextNode
     * @param bool $allowEmpty
     * @return string
     * @throws NetsuiteException
     */
    public static function extractTextFromNode(
        $domXPath, $path, $contextNode, $allowEmpty = false
    ) {
        $items = $domXPath->query($path, $contextNode);
        if (($count = count($items)) !== 1) {
            if ($allowEmpty) {
                return '';
            }
            throw new NetsuiteException("Unexpected count of $count found for - $path");
        }
        return trim($items->item(0)->textContent);
    }
}
