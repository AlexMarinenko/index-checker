<?php

require_once('autoloader.php');

use Checker\Checker;
use Checker\Config\IniFileBasedConfig;
use Checker\Config\RequiredParameterNotFoundException;
use Checker\Data\SQLSiteRepository;
use Checker\Input\FileDataSource;
use Checker\Input\FileNotFoundException;

set_time_limit(0);

if (count($argv) < 2){
    die("\nError: Too few parameters.\nUsage: php checker.php <input-file-name>\n");
}

try{
    $config = new IniFileBasedConfig('etc/checker.ini');
}catch(RequiredParameterNotFoundException $ex){
    die($ex->getMessage()."\n");
}

$dbh = new PDO($config->getDsn());

$siteRepository = new SQLSiteRepository($dbh, $config->appendResults());

try{
    $inputDataSource = new FileDataSource($argv[1]);
}catch(FileNotFoundException $ex){
    die($ex->getMessage()."\n");
}

$checker = new Checker($config, $siteRepository, $inputDataSource);

$checker->start();
