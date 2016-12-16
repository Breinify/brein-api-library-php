<?php
namespace Breinify\API;

/**
 * Class BreinUser
 * @package Breinify\API
 */
class BreinUser
{

    /**
     * @var array of possible attributes when object is created as an array
     */
    public static $validAttributes = [
        "email",
        "firstName",
        "lastName",
        "dateOfBirth",
        "imei",
        "deviceId",
        "sessionId",
        "phone",
        "userAgent",
        "referrer",
        "url",
        "userId",
        "localDateTime",
        "timezone",
        "ipAddress"
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
     * @var string $userAgent contains the userAgent
     */
    private $userAgent = null;

    /**
     * @var string $referrer contains the referrer
     */
    private $referrer = null;

    /**
     * @var string $url contains the url
     */
    private $url = null;

    /**
     * @var string $phone contains the phone
     */
    private $phone = null;

    /**
     * @var string $userId contains the user id
     */
    private $userId = null;

    /**
     * @var string $localDateTime contains the localDateTime
     */
    private $localDateTime = null;

    /**
     * @var string $timezone contains the timezone
     */
    private $timezone = null;

    /**
     * @var string $ipAddress contains the ipAddress
     */
    private $ipAddress = null;

    /**
     * @var array
     */
    private $userMap = array();

    /**
     * @var array
     */
    private $userAdditionalMap = array();

    /**
     * @return array of user related fields
     */
    public function data()
    {
        $requestData = $this->userData();

        $additionalData = $this->additionalData();
        if (count($additionalData) > 0) {
            $requestData['additional'] = $additionalData;
        }

        return $requestData;
    }

    /**
     * crates the data structure for the additional data part
     *
     * @return array
     */
    public function additionalData()
    {
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

        // check if additional base fields are set
        // should be an associative array
        foreach ($this->getUserAdditionalMap() as $key => $value) {
            // echo "\n Key is: " . $key . " Value is: " . $value;
            $requestData[$key] = $value;
        }

        return $requestData;
    }

    /**
     * @return string the email of the user, null if not set
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email the email of the user
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Return the ipAddress
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress sets the ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string the first name of the user
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName the first name of the user
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string the last name of the user
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName the last name of the user
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed the date of birth of the user, can be
     * as unix-timestamp, or formatted string (e.g., MM/dd/yyy)
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth the date of birth of the user, can be
     * as unix-timestamp, or formatted string (e.g., MM/dd/yyy)
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return string the International Mobile Station Equipment Identity (IMEI)
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * @param string $imei the International Mobile Station Equipment Identity (IMEI)
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
    }

    /**
     * @return string the device id used by the user (this might be the android id, or any
     * unique identifier of the device
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param string $deviceId the device id used by the user (this might be the android id, or any
     * unique identifier of the device
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string the identifier of the session
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId the identifier of the session
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string returns the configured userAgent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent value to set
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return string the referrer
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param string $referrer to set
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
    }

    /**
     * @return string the configured url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url to set
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string localDateTime
     */
    public function getLocalDateTime()
    {
        return $this->localDateTime;
    }

    /**
     * @param string $localDateTime
     */
    public function setLocalDateTime($localDateTime)
    {
        $this->localDateTime = $localDateTime;
    }

    /**
     * @return string timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param null $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @param string $phone number to set
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string phone number
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId to set
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     *
     * @return array for the user level
     */
    public function getUserMap()
    {
        return $this->userMap;
    }

    /**
     * sets an additional map (associative array) for the user level
     * @param array $userMap
     */
    public function setUserMap($userMap)
    {
        $this->userMap = $userMap;
    }

    /**
     * @return array for the user additional level
     */
    public function getUserAdditionalMap()
    {
        return $this->userAdditionalMap;
    }

    /**
     * sets an associative array for the user additional level
     * @param array $userAdditionalMap
     */
    public function setUserAdditionalMap($userAdditionalMap)
    {
        $this->userAdditionalMap = $userAdditionalMap;
    }

    /**
     * @return array
     */
    public function userData()
    {
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
            return $requestData;
        }

        // check if additional base fields are set
        // should be an associative array
        foreach ($this->getUserMap() as $key => $value) {
            // echo "\n Key is: " . $key . " Value is: " . $value;
            $requestData[$key] = $value;
        }

        return $requestData;
    }

}