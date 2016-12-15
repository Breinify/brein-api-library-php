<?php

namespace Breinify\API;


class Breinify
{

    private $apiKey;

    private $secret;

    private $engine;

    function __construct($apiKey, $secret = null)
    {
        $engine = new BreinEngine();
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        // echo "ApiKey is: " . $this->apiKey;
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        // echo "Secret is: " . $this->secret;
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param mixed $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    public function setConfig($apiKey, $secret = null)
    {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }

    /**
     * @param BreinActivity $activity
     * @return mixed
     */
    public function sendActivity(BreinActivity &$activity)
    {
        $activity->setApiKey($this->getApiKey());
        $activity->setSecret($this->getSecret());

        $engine = new BreinEngine($this->getEngine());
        return $engine->sendActivity($activity);
    }

    /**
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
     * @param BreinTemporalData $temporalData
     * @return mixed
     */
    public function temporalData(BreinTemporalData &$temporalData)
    {

        $temporalData->setApiKey($this->getApiKey());
        $temporalData->setSecret($this->getSecret());

        $engine = new BreinEngine($this->getEngine());
        return $engine->temporalData($temporalData);
    }

}