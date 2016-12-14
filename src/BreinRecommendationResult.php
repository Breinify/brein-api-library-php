<?php

namespace Breinify\API;

class BreinRecommendationResult
{

    private $resultFromRequest = array();

    function __construct(array $resultFromRequest)
    {
        array_push($this->resultFromRequest, $resultFromRequest);
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->resultFromRequest[0]['status'];
    }

    /**
     * @return mixed
     */
    public function getMessage() {
        return $this->resultFromRequest[0]['result']['message'];
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->resultFromRequest[0]['result']['result'];
    }
}