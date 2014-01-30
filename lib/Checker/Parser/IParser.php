<?php

namespace Checker\Parser;

interface IParser{
    /**
     * Parse content and extract indexed pages amount
     * @param $content content to parse
     * @return int indexed pages amount
     * @throws WrongResponseException
     */
    public function getIndexedPagesCount($content);
}