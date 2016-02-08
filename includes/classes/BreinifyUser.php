<?php
namespace Breinify\API\PHP;

class BreinifyUser {

    private $firstName;
    private $lastName;
    private $email;
    private $dateOfBirth;
    private $imei;
    private $deviceId;
    private $sessionId;

    public function toActivityUser() {
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
}