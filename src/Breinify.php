<?php

namespace Breinify\API;

use Breinify\API\BreinEngine;



class Breinify
{

    private $apiKey;

    private $secret;

    private $engine;

    function __construct()
    {
        $engine = new BreinEngine();
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
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

    public function sendActivity(BreinActivity &$activity)
    {
        $activity->setApiKey($this->getApiKey());
        $activity->setSecret($this->getSecret());

        $eng = new BreinEngine($this->getEngine());
        return $eng->sendActivity($activity);
    }

}