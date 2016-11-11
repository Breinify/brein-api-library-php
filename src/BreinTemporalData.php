<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

/**
 * Class BreinTemporalData
 * @package Breinify\API
 */
class BreinTemporalData {

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
     * @var string $ipAddress contains the ipAddress
     */
    private $ipAddress = null;

    /**
     * BreinActivity constructor.
     */
    public function __construct() {
        $this->setUnixTimestamp(null);
    }

    /**
     * @param object $user contains the breinuser
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
     * @param string $unixTimestamp contains the unixTimeStamp
     */
    public function setUnixTimestamp($unixTimestamp) {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    /**
     * @return object the breinuser
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param string $apiKey sets the apikey
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string the api key
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @return string the unixtimestamp
     */
    public function getUnixTimestamp() {
        return $this->unixTimestamp;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return string the ipAddress
     */
    public function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return array the data array of temporaldata
     */
    public function data() {
        return [
            'user'          => $this->user,
            'apiKey'        => $this->apiKey,
            'unixTimestamp' => $this->unixTimestamp,
            'ipAddress'     => (empty($ipAddress) ? '' : $ipAddress),
            'signature'     => $this->createSignature()
        ];
    }

    /**
     * @return string encoded json data
     */
    public function json() {
        return json_encode($this->data());
    }

    /**
     * @return bool checks if temporaldata contains all necessary data
     */
    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }

    /**
     * @return null|string localedatetime
     */
    public function getLocalDateTime() {
        $additionalArray = $this->user["additional"];
        if ($additionalArray != null) {
            $localDateTime = $additionalArray["localDateTime"];
            if ($localDateTime != null) {
                return $localDateTime;
            }
        }

        return null;
    }

    /**
     * @return null|string time zone (if set)
     */
    public function getTimezone() {
        $additionalArray = $this->user["additional"];
        if ($additionalArray != null) {
            $timezone = $additionalArray["timezone"];
            if ($timezone != null) {
                return $timezone;
            }
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function createSignature() {

        if (empty($this->secret)) {
            return null;
        } else {

            $localDateTime = $this->getLocalDateTime();
            // error_log("localDateTime is: "); error_log($localDateTime);
            $paraLocalDateTime = $localDateTime == null ? "" : $localDateTime;

            $timezone = $this->getTimezone();
            // error_log("timezone is: "); error_log($timezone);
            $paraTimezone = $timezone == null ? "" : $timezone;
            
            $message = sprintf("%d-%s-%s",
                $this->unixTimestamp, $paraLocalDateTime, $paraTimezone);

            return base64_encode(hash_hmac('sha256', $message, $this->secret, true));
        }
    }

}