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
     * @param BreinActivity $activity
     * @return array -> result from request
     */
    public function sendActivity(BreinActivity &$activity)
    {
        $activity->setApiKey($this->getApiKey());
        $activity->setSecret($this->getSecret());

        $engine = new BreinEngine($this->getEngine());
        return $engine->sendActivity($activity);
    }

    /**
     * sends a recommendation request to the eninge
     *
     * @param BreinRecommendation $recommendation
     * @return BreinRecommendationResult
     */
    public function recommendation(BreinRecommendation &$recommendation)
    {
        $recommendation->setApiKey($this->getApiKey());
        $recommendation->setSecret($this->getSecret());

        $engine = new BreinEngine($this->getEngine());
        $result = $engine->recommendation($recommendation);
        return new BreinRecommendationResult($result);
    }

    /**
     * invokes a temporalData request
     *
     * @param BreinTemporalData $temporalData
     * @return array of results
     */
    public function temporalData(BreinTemporalData &$temporalData)
    {

        $temporalData->setApiKey($this->getApiKey());
        $temporalData->setSecret($this->getSecret());

        $engine = new BreinEngine($this->getEngine());
        return $engine->temporalData($temporalData);
    }

}