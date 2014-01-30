<?php

namespace Checker\Parser;

use Checker\SearchEngine;

class ParserFactory{

    /**
     * Returns Parser accoring to SearchEngine selection
     * @param int $searhEngine SearchEngine
     * @throws \Exception
     * @return IParser a parser for the search engine
     */
    public static function getParser($searhEngine){

        switch($searhEngine){

            case SearchEngine::GOOGLE:
                return new GoogleSiteParser();

            case SearchEngine::GOOGLE_API:
                return new GoogleParser();

            // Other search engines could be added

            default:
                throw new \Exception("Unknown search engine passed.");

        }
    }

}