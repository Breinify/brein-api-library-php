<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;
use Breinify\API\BreinUser;

/**
 * Class BreinTemporalData
 * @package Breinify\API
 */
class BreinTemporalData extends BreinBase {

    /**
     * @var string $ipAddress contains the ipAddress
     */
    private $ipAddress = null;

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

        $requestData = array();

        if (!empty($this->getUser())) {
            $requestData['user'] = $this->getUser();
        }

        if (!empty($this->getApiKey())) {
            $requestData['apiKey'] = $this->getApiKey();
        }

        if (!empty($this->getUnixTimestamp())) {
            $requestData['unixTimestamp'] = $this->getUnixTimestamp();
        }

        if (!empty($this->getSecret())) {
            $requestData['signature'] = $this->createSignature();
        }

        if (!empty($this->ipAddress)) {
            $requestData['ipAddress'] = $this->ipAddress;
        }

        return $requestData;
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
        return !empty($this->getApiKey() &&
            !empty($this->getUser()) && is_array($this->getUser()) && count($this->getUser()) > 0);
    }

    /**
     * @return null|string
     */
    public function createSignature() {

        error_log("Invoking createSignature from BreinTemporalData");

        if (empty($this->getSecret())) {
            return null;
        } else {
            $user = new BreinUser($this->getUser());
            $localDateTime = $user->getLocalDateTime();
            // error_log("localDateTime is: "); error_log($localDateTime);
            $paraLocalDateTime = $localDateTime == null ? "" : $localDateTime;

            $timezone = $user->getTimezone();
            // error_log("timezone is: "); error_log($timezone);
            $paraTimezone = $timezone == null ? "" : $timezone;
            
            $message = sprintf("%d-%s-%s",
                $this->getUnixTimestamp(), $paraLocalDateTime, $paraTimezone);

            return base64_encode(hash_hmac('sha256', $message, $this->getSecret(), true));
        }
    }

}