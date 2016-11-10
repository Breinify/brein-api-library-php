<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

class BreinTemporalData {

    private $apiKey = null;
    private $secret = null;
    private $unixTimestamp = null;
    private $user = null;
    private $ipAddress = null;


    public function __construct() {
        $this->setUnixTimestamp(null);
    }

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

    public function setUnixTimestamp($unixTimestamp) {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    public function getUser() {
        return $this->user;
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getUnixTimestamp() {
        return $this->unixTimestamp;
    }

    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return null
     */
    public function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * @param null $ipAddress
     */
    public function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    public function data() {
        return [
            'user'          => $this->user,
            'apiKey'        => $this->apiKey,
            'unixTimestamp' => $this->unixTimestamp,
            'ipAddress'     => (empty($ipAddress) ? '' : $ipAddress),
            'signature'     => $this->createSignature()
        ];
    }

    public function json() {
        return json_encode($this->data());
    }

    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }

    /**
     * @return null|string
     */
    public function createSignature() {

        if (empty($this->secret)) {
            return null;
        } else {

            error_log("----- USER ----");
            error_log(print_r($this->user,1));
            error_log("-----");

            $localDateTime = $this->user->getLocalDateTime();
            $timeZone = $this->user->getTimezone();
            error_log("===================");
            error_log("localDateTime");
            error_log($localDateTime);
            error_log($timeZone);
            error_log("===================");
            return;

            $paraLocalDateTime = $localDateTime == null ? "" : $localDateTime;

            $paraTimezone = $timeZone == null ? "" : $timeZone;

            $message = sprintf("%d-%s-%s",
                $this->unixTimestamp, $paraLocalDateTime, $paraTimezone);

            return base64_encode(hash_hmac('sha256', $message, $this->secret, true));
        }
    }
}