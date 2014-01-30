<?php

namespace Checker;

use Checker\Config\IConfig;
use Checker\Data\ISiteRepository;
use Checker\Data\Model\Site;
use Checker\Downloader\MultiDownloader;
use Checker\Input\IInputDataSource;
use Checker\Parser\ParserFactory;
use Checker\Parser\WrongResponseException;
use Checker\UrlBuilder\UrlBuilderfactory;

class Checker {
    /**
     * @var Data\ISiteRepository
     */
    private $repository;
    /**
     * @var IInputFileParser
     */
    private $inputFileParser;
    /**
     * @var int
     */
    private $numThreads;
    /**
     * @var SearchEngine
     */
    private $searchEngine;

    private $running;

    /**
     * @var UrlBuilder\IUrlBuilder
     */
    private $urlBuilder;

    /**
     * @var Parser\IParser
     */
    private $contentParser;

    /**
     * @var IConfig
     */
    private $config;

    /**
     * @param IConfig $config configurator
     * @param ISiteRepository $repository storage repository
     * @param IInputDataSource $inputDataSource input data source
     */
    public function __construct(IConfig $config, ISiteRepository $repository, IInputDataSource $inputDataSource){
        $this->repository = $repository;
        $this->inputFileParser = $inputDataSource;
        $this->numThreads = $config->getThreads();
        $this->searchEngine = $config->getEngine();
        $this->urlBuilder = UrlBuilderfactory::getBuilder($this->searchEngine);
        $this->contentParser = ParserFactory::getParser($this->searchEngine);
        $this->config = $config;
    }

    /**
     * Start processing
     */
    public function start(){

        $this->running = true;

        while($this->running){
            $this->startThreads();
        }

    }

    /**
     * Start current batch download and store results
     */
    private function startThreads()
    {
        $results = $this->download();
        $this->storeResults($results);
    }

    /**
     * Stop processing
     */
    private function stop()
    {
        $this->running = false;
    }

    /**
     * Download current batch
     * @return array downloaded content
     */
    private function download()
    {

        $i = $this->config->getThreads();

        $downloader = new MultiDownloader();

        // Initialize current batch
        do{
            $url = $this->inputFileParser->getNext();
            $builtUrl = $this->urlBuilder->getUrl($url);
            $downloader->addUrl($url, $builtUrl);
            echo "Url: " . $url . "\n";
        }while( (--$i > 0) && ($url != null));

        if ($url == null){
            // Stop main cycle if there is nothing to process
            $this->stop();
        }

        return $downloader->download();

    }

    private function storeResults(array $results)
    {
        foreach($results as $domain => $content){
            try{
                $idx = $this->contentParser->getIndexedPagesCount($content);
            }catch (WrongResponseException $ex){
                // Fail on parsing error
                echo $ex->getMessage();
                $this->stop();
                return;
            }
            $site = new Site($domain, $idx);
            $this->repository->add($site);
        }
    }


}
