<?php
namespace Breinify\API;

/**
 * Class BreinUser
 * @package Breinify\API
 */
class BreinUser {

    public static $validAttributes = [
        "email", "firstName", "lastName",
        "dateOfBirth", "imei", "deviceId",
        "sessionId"
    ];

    /**
     * @var string $firstName the first name of the user
     */
    private $firstName = null;

    /**
     * @var string $lastName the last name of the user
     */
    private $lastName = null;

    /**
     * @var string $email the email of the user
     */
    private $email = null;

    /**
     * @var string $dateOfBirth contains the birthday of the user
     */
    private $dateOfBirth = null;

    /**
     * @var string $imei contains the imei number of user's device
     */
    private $imei = null;

    /**
     * @var string $deviceId contains the device id of the user
     */
    private $deviceId = null;

    /**
     * @var string $sessionId contains the session id
     */
    private $sessionId = null;

    /**
     * @var null
     */
    private $userAgent = null;

    /**
     * @var null
     */
    private $referrer = null;

    /**
     * @var null
     */
    private $url = null;

    /**
     * @var null
     */
    private $phone = null;

    /**
     * @var null
     */
    private $userId = null;

    /**
     * @var null
     */
    private $localDateTime = null;

    /**
     * @var null
     */
    private $timezone = null;

    /**
     * @return array of user related fields
     */
    public function data() {

        $requestData = array();

        if (!empty($this->email)) {
            $requestData['email'] = $this->email;
        }

        if (!empty($this->firstName)) {
            $requestData['firstName'] = $this->firstName;
        }

        if (!empty($this->lastName)) {
            $requestData['lastName'] = $this->lastName;
        }

        if (!empty($this->dateOfBirth)) {
            $requestData['dateOfBirth'] = $this->dateOfBirth;
        }

        if (!empty($this->imei)) {
            $requestData['imei'] = $this->imei;
        }

        if (!empty($this->deviceId)) {
            $requestData['deviceId'] = $this->deviceId;
        }

        if (!empty($this->sessionId)) {
            $requestData['sessionId'] = $this->sessionId;
        }

        if (!empty($this->phone)) {
            $requestData['phone'] = $this->phone;
        }

        if (!empty($this->userId)) {
            $requestData['userId'] = $this->userId;
        }

        $additionalData = $this->additionalData();
        if (count($additionalData) > 0) {
            $requestData['additional'] = $additionalData;
        }

        return $requestData;
    }

    /**
     * crates the data structure for the addtional data part
     *
     * @return array
     */
    public function additionalData() {

        $requestData = array();

        if (!empty($this->userAgent)) {
            $requestData['userAgent'] = $this->userAgent;
        }

        if (!empty($this->referrer)) {
            $requestData['referrer'] = $this->referrer;
        }

        if (!empty($this->url)) {
            $requestData['url'] = $this->url;
        }

        if (!empty($this->localDateTime)) {
            $requestData['localDateTime'] = $this->localDateTime;
        }

        if (!empty($this->timezone)) {
            $requestData['timezone'] = $this->timezone;
        }

        return $requestData;
    }

    /**
     * @return string the email of the user, null if not set
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email the email of the user
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string the first name of the user
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param string $firstName the first name of the user
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @return string the last name of the user
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param string $lastName the last name of the user
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed the date of birth of the user, can be
     * as unix-timestamp, or formatted string (e.g., MM/dd/yyy)
     */
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth the date of birth of the user, can be
     * as unix-timestamp, or formatted string (e.g., MM/dd/yyy)
     */
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string the International Mobile Station Equipment Identity (IMEI)
     */
    public function getImei() {
        return $this->imei;
    }

    /**
     * @param string $imei the International Mobile Station Equipment Identity (IMEI)
     */
    public function setImei($imei) {
        $this->imei = $imei;
    }

    /**
     * @return string the device id used by the user (this might be the android id, or any
     * unique identifier of the device
     */
    public function getDeviceId() {
        return $this->deviceId;
    }

    /**
     * @param string $deviceId the device id used by the user (this might be the android id, or any
     * unique identifier of the device
     */
    public function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string the identifier of the session
     */
    public function getSessionId() {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId the identifier of the session
     */
    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    /**
     * @return null
     */
    public function getUserAgent() {
        return $this->userAgent;
    }

    /**
     * @param null $userAgent
     */
    public function setUserAgent($userAgent) {
        $this->userAgent = $userAgent;
    }

    /**
     * @return null
     */
    public function getReferrer() {
        return $this->referrer;
    }

    /**
     * @param null $referrer
     */
    public function setReferrer($referrer) {
        $this->referrer = $referrer;
    }

    /**
     * @return null
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param null $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return null
     */
    public function getLocalDateTime() {
        return $this->localDateTime;
    }

    /**
     * @param null $localDateTime
     */
    public function setLocalDateTime($localDateTime) {
        $this->localDateTime = $localDateTime;
    }

    /**
     * @return null
     */
    public function getTimezone() {
        return $this->timezone;
    }

    /**
     * @param null $timezone
     */
    public function setTimezone($timezone) {
        $this->timezone = $timezone;
    }

    public function setPhone($string)
    {
        $this->phone = $string;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param null $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}