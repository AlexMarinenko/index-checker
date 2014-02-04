<?php

namespace Checker\UrlBuilder;

use Checker\SearchEngine;

class UrlBuilderFactory{

    /**
     * Returns UrlBuilder according to selected SearchEngine
     * @param $searchEngine int search engine
     * @throws \Exception
     * @return IUrlBuilder for selected search engine
     */
    public static function getBuilder($searchEngine){

        switch($searchEngine){

            case SearchEngine::GOOGLE_API:
                return new GoogleUrlBuilder();

            case SearchEngine::GOOGLE:
                return new GoogleSiteUrlBuilder();

            // Other search engine implementations

            default:
                throw new \Exception("Unknown search engine passed.");
        }

    }
}