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
        $sessionId = empty(session_id()) ? null : session_id();

        if (get_class($user) === 'Breinify\API\BreinUser') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user = $user->data();
        } else if (get_class($user) === 'WP_User') {
            $this->user = [
                'email'     => $user->user_email,
                'firstName' => $user->user_firstname,
                'lastName'  => $user->user_lastname,
                'sessionId' => $sessionId,
                'signature' => $this->createSignature()
            ];
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

    /*
    public function setData($data) {

        // validate the data first
        if (is_array($data) &&
            (!empty($data['activities']) || !empty($data['activity'])) &&
            !empty($data['apiKey']) &&
            !empty($data['user'])
        ) {
            $this->user = $data['user'];
            $this->activities = (!empty($data['activities']) ? $data['activities'] : [$data['activity']]);
            $this->apiKey = $data['apiKey'];
            $this->unixTimestamp = empty($data['unixTimestamp']) ? $this->unixTimestamp : $data['unixTimestamp'];

            return true;
        } else {
            return false;
        }
    }
    */

    public function json() {
        return json_encode($this->data());
    }

    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }

    /*
    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->activities) && is_array($this->activities) && count($this->activities) > 0 &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }
    */

    public function createSignature() {

        if (empty($this->secret)) {
            return null;
        } else {

            $localDateTime = $this->getUser()->getUserAdditional().getLocalDateTime();
            $paraLocalDateTime = $localDateTime == null ? "" : $localDateTime;

            $timeZone = $this->getUser()->getUserAdditional().getTimezone();
            $paraTimezone = $timeZone == null ? "" : $timeZone;

            $message = sprintf("%d-%s-%s",
                $this->unixTimestamp, $paraLocalDateTime, $paraTimezone);

            return base64_encode(hash_hmac('sha256', $message, $this->secret, true));
        }
    }
}