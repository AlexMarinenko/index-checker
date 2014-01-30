<?php

require_once('autoloader.php');

use Checker\Checker;
use Checker\Config\IniFileBasedConfig;
use Checker\Config\RequiredParameterNotFoundException;
use Checker\Data\SQLSiteRepository;
use Checker\Input\FileDataSource;

set_time_limit(0);

if (count($argv) < 2){
    die("\nError: Too few parameters.\nUsage: php checker.php <input-file-name>\n");
}

try{
    $config = new IniFileBasedConfig('etc/checker.ini');
}catch(RequiredParameterNotFoundException $ex){
    die($ex);
}

$dbh = new PDO($config->getDsn());

$siteRepository = new SQLSiteRepository($dbh, $config->appendResults());

$inputDataSource = new FileDataSource('test.txt');

$checker = new Checker($config, $siteRepository, $inputDataSource);

$checker->start();
