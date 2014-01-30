<?php

namespace Checker\Downloader;

interface IDownloader{

    /**
     * Downloads selected content
     * @return content
     */
    function download();

    /**
     * Adds url for download
     * @param $domain
     * @param $url add url to download
     * @return
     */
    function addUrl($domain, $url);

}