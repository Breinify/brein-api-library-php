<?php

namespace Breinify\API;

/**
 * Class BreinRecommendationResult
 * @package Breinify\API
 *
 */
class BreinRecommendationResult
{
    /**
     * @var array contains the recommendation response
     */
    private $resultFromRequest = array();

    /**
     * BreinRecommendationResult constructor.
     * @param array $resultFromRequest
     */
    function __construct(array $resultFromRequest)
    {
        array_push($this->resultFromRequest, $resultFromRequest);
    }

    /**
     * Provides the HTTP status of the invoked request
     * @return int
     */
    public function getStatus()
    {
        return $this->resultFromRequest[0]['status'];
    }

    /**
     * Provides the message that is part of the response from a recommendation request.
     * @return string
     */
    public function getMessage()
    {
        return $this->resultFromRequest[0]['result']['message'];
    }

    /**
     * Provides an array of recommendation results
     * @return array of recommendations.
     */
    public function getResults()
    {
        return $this->resultFromRequest[0]['result']['result'];
    }
}