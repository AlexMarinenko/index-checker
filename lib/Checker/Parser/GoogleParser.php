<?php

namespace Checker\Parser;

class GoogleParser implements IParser
{


    public function getIndexedPagesCount($content)
    {

        $indexed = 0;

        $results = json_decode($content);

        if ($results == null || !$this->isValid($results)) {
            throw new WrongResponseException($content);
        }

        if (isset($results->responseData->cursor->estimatedResultCount)) {
            $indexed = $results->responseData->cursor->estimatedResultCount;
        }


        return $indexed;
    }

    private function isValid($results)
    {
        return ($results->responseStatus == 200);
    }

}