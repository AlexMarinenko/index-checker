<?php

namespace Checker\Input;

interface IInputDataSource{
    /**
     * @return string next domain from input source
     */
    function getNext();
}