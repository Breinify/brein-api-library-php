<?php

namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

class BreinBase
{
    /**
     * @var string $apiKey contains the apikey
     */
    private $apiKey = null;

    /**
     * @var string $secret contains the secret
     */
    private $secret = null;

    /**
     * @var string $unixTimestamp contains the unixTimestamp
     */
    private $unixTimestamp = null;

    /**
     * @var object $user contains the user object
     */
    private $user;

    /**
     * @var array of additional fields for base section
     */
    private $baseMap = array();

    /**
     * BreinBase constructor.
     */
    public function __construct()
    {
        $this->setUnixTimestamp(null);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string the secret
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param $secret string
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return int the timestamp
     */
    public function getUnixTimestamp()
    {
        return $this->unixTimestamp;
    }

    /**
     * @param long $unixTimestamp
     */
    public function setUnixTimestamp($unixTimestamp)
    {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    /**
     * @return BreinUser the user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @throws \Exception
     */
    public function setUserFromArray($user)
    {
        if (is_object($user) && get_class($user) === 'Breinify\API\BreinUser') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user = $user->data();
        } else if (is_array($user)) {
            $this->user = BreinUtil::filterArray($user, BreinUser::$validAttributes);
        } else {
            throw new \Exception('Invalid user type: ' . $user);
        }
    }

    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * prepares the data for the request
     */
    public function data()
    {
        $requestData = array();

        $requestData['user'] = $this->getUser()->data();
        $requestData['apiKey'] = $this->getApiKey();
        $requestData['unixTimestamp'] = $this->getUnixTimestamp();

        // ipAddress is configured on BreinUser but needs to be
        // inserted in base section
        $ipAddress = $this->getUser()->getIpAddress();
        if (!empty($ipAddress)) {
            $requestData['ipAddress'] = $ipAddress;
        }

        return $requestData;
    }

}