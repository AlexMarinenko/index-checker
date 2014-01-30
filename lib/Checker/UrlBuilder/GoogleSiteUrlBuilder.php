<?php

namespace Checker\UrlBuilder;

class GoogleSiteUrlBuilder implements IUrlBuilder{

    /**
     * @param $domain domain name
     * @return string url
     */
    function getUrl($domain)
    {
        $urlTemplate = "https://www.google.com/search?q=site:%s";
        return sprintf($urlTemplate, $domain);
    }
}

