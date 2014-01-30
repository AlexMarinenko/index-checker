<?php

namespace Checker\Downloader;

class MultiDownloader implements IDownloader{

    /**
     * @var array
     */
    private $urls;

    /**
     * @var resource
     */
    private $mh;

    /**
     * @var array
     */
    private $curlArray;

    public function __construct(){
        $this->urls = array();
        $this->mh = curl_multi_init();
        $this->curlArray = array();
    }

    /**
     * @param add $domain
     * @param $url add url to download
     */
    public function addUrl($domain, $url){
        $this->urls[$domain] = $url;
    }

    /**
     * @return array of the urls content indexed the same way as the input urls array
     */
    public function download(){

        // Init download handlers
        $this->initHandles();

        // Start downloading content
        $this->executeHandles();

        // Collect downloaded content
        $res = array();
        foreach($this->urls as $i => $url)
        {
            $res[$i] = curl_multi_getcontent($this->curlArray[$i]);
        }

        $this->disposeHandles();

        return $res;
    }

    /**
     * Initializes handles for urls
     */
    private function initHandles()
    {
        foreach($this->urls as $i => $url)
        {
            $this->curlArray[$i] = curl_init($url);
            curl_setopt($this->curlArray[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($this->mh, $this->curlArray[$i]);
        }
    }

    /**
     * Downloads initialized urls
     */
    private function executeHandles()
    {
        $running = NULL;
        // Wait when all the threads finished
        do {
            usleep(10000);
            curl_multi_exec($this->mh,$running);
        } while($running > 0);
    }

    /**
     * Disposes curl resources
     */
    private function disposeHandles()
    {
        curl_multi_close($this->mh);
    }



}