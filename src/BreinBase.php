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
    private $user = null;

    public function __construct() {
        $this->setUnixTimestamp(null);
    }

    /**
     * @return null
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param null $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param null $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return null
     */
    public function getUnixTimestamp()
    {
        return $this->unixTimestamp;
    }

    /**
     * @param null $unixTimestamp
     */
    public function setUnixTimestamp($unixTimestamp) {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @throws \Exception
     */
    public function setUser($user) {

        if (is_object($user) && get_class($user) === 'Breinify\API\BreinUser') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user = $user->data();
        } else if (is_array($user)) {
            $this->user = BreinUtil::filterArray($user, BreinUser::$validAttributes);
        } else {
            throw new \Exception('Invalid user type: ' . $user);
        }
    }

    /**
     *
     */
    public function data()
    {
        $requestData = array();

        $requestData['user'] = $this->getUser();
        $requestData['apiKey'] = $this->getApiKey();
        $requestData['unixTimestamp'] = $this->getUnixTimestamp();

        return $requestData;
    }

}