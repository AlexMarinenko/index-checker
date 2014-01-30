<?php

namespace Checker\Config;

use Checker\SearchEngine;


class IniFileBasedConfig implements IConfig{

    private $config;
    private $dsn;
    private $threads;
    private $searchEngine;
    private $appendResults;

    /**
     * @param $fileName
     * @throws WrongConfigException
     */
    public function __construct($fileName){

        $this->config = parse_ini_file($fileName);

        if (!$this->config){
            throw new WrongConfigException('Wrong config file: ' . $fileName);
        }

        $this->parse();
    }

    function getDsn()
    {
        return $this->dsn;
    }

    function getThreads()
    {
        return $this->threads;
    }

    function getEngine()
    {
        return $this->searchEngine;
    }

    function appendResults()
    {
        return $this->appendResults;
    }

    private function parse()
    {

        if (isset($this->config['dsn']) && trim($this->config['dsn']) != ''){
            $this->dsn = trim($this->config['dsn']);
        }else{
            throw new RequiredParameterNotFoundException('Required parameter [dsn] not defined.');
        }

        if (isset($this->config['threads']) && $this->config['threads'] > 0){
            $this->threads = trim($this->config['threads']);
        }else{
            throw new RequiredParameterNotFoundException('Required parameter [threads] not defined.');
        }

        if (isset($this->config['engine']) && trim($this->config['engine']) != ''){
            $this->searchEngine = SearchEngine::valueOf($this->config['engine']);
        }else{
            throw new RequiredParameterNotFoundException('Required parameter [engine] not defined.');
        }

        if (isset($this->config['appendResults'])){
            $this->appendResults = (trim(strtolower($this->config['appendResults'])) == 'true');
        }else{
            throw new RequiredParameterNotFoundException('Required parameter [appendResults] not defined.');
        }
    }
}