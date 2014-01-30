<?php

namespace Checker;

class SearchEngine{
    const GOOGLE = 1;
    const GOOGLE_API = 2;

    /**
     * Parse SearchEngine using input string
     * @param $engine
     * @return int
     * @throws UnknowSearchEngineException
     */
    public static function valueOf($engine)
    {
        $string = trim(strtoupper($engine));
        switch($string){
            case 'GOOGLE':
                return self::GOOGLE;
            case 'GOOGLE_API':
                return self::GOOGLE_API;
            default:
                throw new UnknowSearchEngineException('Unknown search engine: ' . $engine);
        }
    }
}