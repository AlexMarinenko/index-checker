<?php

require_once('autoloader.php');

use Checker\Config\IniFileBasedConfig;
use Checker\Config\RequiredParameterNotFoundException;
use Checker\Data\SQLSiteRepository;

try{
    $config = new IniFileBasedConfig('etc/checker.ini');
}catch(RequiredParameterNotFoundException $ex){
    die($ex);
}

$dbh = new PDO($config->getDsn());

$siteRepository = new SQLSiteRepository($dbh, $config->appendResults());


echo json_encode($siteRepository->getStats(10));