<?php

namespace Breinify\API;


class Breinify
{

    /**
     * @var string - contains the apiKey
     */
    private $apiKey;

    /**
     * @var string - contains the secret
     */
    private $secret;

    /**
     * @var BreinEngine -> check if necessary
     */
    private $engine;

    function __construct($apiKey, $secret = null)
    {
        $this->engine = new BreinEngine();
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }

    /**
     * returns the apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        // echo "ApiKey is: " . $this->apiKey;
        return $this->apiKey;
    }

    /**
     * sets the apiKey
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * returns the secret, might be null
     * @return null|string
     */
    public function getSecret()
    {
        // echo "Secret is: " . $this->secret;
        return $this->secret;
    }

    /**
     * sets the secret
     *
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * returns the breinEngine instance
     *
     * @return BreinEngine
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * sets the brein engine instance
     *
     * @param BreinEngine $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * sets curl as an engine type
     */
    public function setCurlEngineType()
    {
        $this->getEngine()->setType("curl");
    }

    /**
     * sets stream as an engine type
     */
    public function setStreamEngineType()
    {
        $this->getEngine()->setType("stream");
    }

    /**
     * configures the breinify instance
     *
     * @param string $apiKey
     * @param string $secret
     */
    public function setConfig($apiKey, $secret = null)
    {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }

    /**
     * sends an activity request to the engine
     *
     * @param BreinActivity $activity (reference)
     * @return array -> result from request
     */
    public function sendActivity(BreinActivity &$activity)
    {
        $activity->setApiKey($this->getApiKey());
        $activity->setSecret($this->getSecret());

        return $this->getEngine()->sendActivity($activity);
    }

    /**
     * sends a recommendation request to the engine
     *
     * @param BreinRecommendation $recommendation (reference)
     * @return BreinRecommendationResult
     */
    public function recommendation(BreinRecommendation &$recommendation)
    {
        $recommendation->setApiKey($this->getApiKey());
        $recommendation->setSecret($this->getSecret());

        $result = $this->getEngine()->recommendation($recommendation);
        return new BreinRecommendationResult($result);
    }

    /**
     * invokes a temporalData request
     *
     * @param BreinTemporalData $temporalData (reference)
     * @return array of results
     */
    public function temporalData(BreinTemporalData &$temporalData)
    {

        $temporalData->setApiKey($this->getApiKey());
        $temporalData->setSecret($this->getSecret());

        return $this->getEngine()->temporalData($temporalData);
    }

}