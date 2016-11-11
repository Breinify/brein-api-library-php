<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

/**
 * Class BreinRecommendation
 * @package Breinify\API
 */
class BreinRecommendation {

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

    /**
     * BreinActivity constructor.
     */
    public function __construct() {
        $this->setUnixTimestamp(null);
    }

    /**
     * @param object $user set the user object
     * @throws \Exception
     */
    public function setUser($user) {

        if (get_class($user) === 'Breinify\API\BreinUser') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user = $user->data();
        } else if (is_array($user)) {
            $this->user = BreinUtil::filterArray($user, BreinUser::$validAttributes);
        } else {
            throw new \Exception('Invalid user type: ' . $user);
        }
    }

    /**
     * @param $unixTimestamp
     */
    public function setUnixTimestamp($unixTimestamp) {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    /**
     * @return null
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * @return null
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @return null
     */
    public function getUnixTimestamp() {
        return $this->unixTimestamp;
    }

    /**
     * @param $secret
     */
    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return array
     */
    public function data() {
        return [
            'user'          => $this->user,
            'apiKey'        => $this->apiKey,
            'unixTimestamp' => $this->unixTimestamp
        ];
    }

    /**
     * @return string
     */
    public function json() {
        return json_encode($this->data());
    }

    /**
     * @return bool
     */
    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }

}