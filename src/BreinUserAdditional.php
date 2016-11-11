<?php
namespace Breinify\API;

/**
 * Class BreinUserAdditional
 * @package Breinify\API
 */
class BreinUserAdditional {

    public static $validAttributes = [
        "userAgent", "referrer", "url",
        "localDateTime", "timezone"
    ];

    private $userAgent = null;
    private $referrer = null;
    private $url = null;
    private $localDateTime = null;
    private $timezone = null;

    /**
     * @return array
     */
    public function data() {
        return [
            'userAgent'     => $this->userAgent,
            'referrer'      => $this->referrer,
            'url'           => $this->url,
            'localDateTime' => $this->localDateTime,
            'timezone'      => $this->timezone
        ];
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

}