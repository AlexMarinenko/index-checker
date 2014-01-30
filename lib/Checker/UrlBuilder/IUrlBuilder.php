<?php

namespace Checker\UrlBuilder;

interface IUrlBuilder{
    /**
     * @param $domain domain name
     * @return string url
     */
    function getUrl($domain);
}