<?php

namespace Checker\Data\Model;

class Site {

    public $domain;
    public $indexed;

    public function __construct($domain, $indexed){
        $this->domain = $domain;
        $this->indexed = $indexed;
    }
}