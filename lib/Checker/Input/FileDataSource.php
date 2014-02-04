<?php

namespace Checker\Input;

class FileDataSource implements IInputDataSource{

    /**
     * @var array
     */
    var $lines;
    /**
     * @var file
     */
    private $fileName;

    /**
     * @param $fileName file to read as source
     */
    public function __construct($fileName){
        $this->fileName = $fileName;
        $this->initDataSource();
    }

    /**
     * @return string domain name
     */
    function getNext()
    {
        return trim(array_pop($this->lines));
    }

    /**
     * initializes input data source for reading
     */
    private function initDataSource()
    {
        $file = @file($this->fileName);
        if ($file === false){
            throw new FileNotFoundException("File " . $this->fileName . " not found.");
        }
        $this->lines = array_reverse($file);
    }
}