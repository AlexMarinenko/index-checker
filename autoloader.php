<?php

spl_autoload_register(function ($class) {
    $path = './lib/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    include $path;
});


try{
    $config = new IniFileBasedConfig('etc/checker.ini');
}catch(RequiredParameterNotFoundException $ex){
    die($ex);
}

$dbh = new PDO($config->getDsn());

$siteRepository = new SQLSiteRepository($dbh, $config->appendResults());
