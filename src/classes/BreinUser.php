<?php
namespace Breinify\API\classes;

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

    public function data() {
        return [
            'email'       => $this->email,
            'firstName'   => $this->firstName,
            'lastName'    => $this->lastName,
            'dateOfBirth' => $this->dateOfBirth,
            'imei'        => $this->imei,
            'deviceId'    => $this->deviceId,
            'sessionId'   => $this->sessionId
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
}