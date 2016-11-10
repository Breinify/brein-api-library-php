<?php
namespace Breinify\API;

use Breinify\API\BreinUserAdditional;

class BreinUser {

    public static $validAttributes = [
        "email", "firstName", "lastName",
        "dateOfBirth", "imei", "deviceId",
        "sessionId"
    ];

    private $firstName = null;
    private $lastName = null;
    private $email = null;
    private $dateOfBirth = null;
    private $imei = null;
    private $deviceId = null;
    private $sessionId = null;
    private $user_additional = null;
    private $localDateTime = null;
    private $timezone = null;

    /**
     * @return null
     */
    public function getLocalDateTime()
    {
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

    public function data() {

        return [
            'email'       => $this->email,
            'firstName'   => $this->firstName,
            'lastName'    => $this->lastName,
            'dateOfBirth' => $this->dateOfBirth,
            'imei'        => $this->imei,
            'deviceId'    => $this->deviceId,
            'sessionId'   => $this->sessionId,
            'additional'  => $this->user_additional
        ];
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
    public function getUserAdditional() {
        return $this->user_additional;
    }

    /**
     * @param $user_additional
     * @throws \Exception
     *
     */
    public function setUserAdditional($user_additional) {

        $this->localDateTime = $user_additional->getLocalDateTime();
        $this->timezone = $user_additional->getTimezone();

        if (get_class($user_additional) === 'Breinify\API\BreinUserAdditional') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user_additional = $user_additional->data();
        } else if (is_array($user_additional)) {
            $this->user_additional = $user_additional;
        } else {
            throw new \Exception('Invalid user additional type: ' . $user_additional);
        }
    }
    
}