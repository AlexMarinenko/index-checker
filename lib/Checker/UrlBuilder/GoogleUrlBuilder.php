<?php

namespace Checker\UrlBuilder;

class GoogleUrlBuilder implements IUrlBuilder{

    /**
     * @param $domain domain name
     * @return string url
     */
    function getUrl($domain)
    {
        $urlTemplate = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&filter=0&q=site:%s";
        return sprintf($urlTemplate, $domain);
    }
}