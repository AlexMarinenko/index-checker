<?php

namespace Checker\Config;

interface IConfig {

    /**
     * @return string DSN
     */
    function getDsn();

    /**
     * @return int threads number
     */
    function getThreads();

    /**
     * @return SearchEngine selected search engine
     */
    function getEngine();

    /**
     * @return boolean do append the results or clear table
     */
    function appendResults();

}