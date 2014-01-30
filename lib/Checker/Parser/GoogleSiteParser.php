<?php

namespace Checker\Parser;

class GoogleSiteParser implements IParser{

    public function getIndexedPagesCount($content)
    {

        $indexed = 0;

        if (!$this->isValid($content)){
            throw new WrongResponseException('Captcha redirection detected.');
        }

        preg_match('/<div[^>]*id="resultStats">([^<]*)</', html_entity_decode($content), $matches);

        if (count($matches) == 2){
            $result = $matches[1];
            $indexed = (int)preg_replace("/[^0-9]/", "", $result);
        }

        return $indexed;

    }

    public function isValid($content){
        return (strpos($content, 'ipv4.google.com/sorry') === 0);
    }

}