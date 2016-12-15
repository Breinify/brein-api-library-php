<?php
namespace Breinify\API;

/**
 * Class BreinRecommendation
 * @package Breinify\API
 */
class BreinRecommendation extends BreinBase
{

    /**
     * @var int $numberOfRecommendations contains the number of recommendations with default of 3
     */
    private $numberOfRecommendations = 3;

    /**
     * BreinActivity constructor.
     */
    public function __construct()
    {
        $this->setUnixTimestamp(null);
    }

    /**
     * @return array
     */
    public function data()
    {
        $requestData = parent::data();

        if (!empty($this->getSecret())) {
            $requestData['signature'] = $this->createSignature();
        }

        $recommendationFields = array();
        $recommendationFields['numRecommendations'] = $this->numberOfRecommendations;

        $requestData['recommendation'] = $recommendationFields;

        // echo("content of recommendation-data is: ");
        // echo(print_r($requestData),1);

        return $requestData;
    }

    /**
     * @return string
     */
    public function json()
    {
        return json_encode($this->data());
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !empty($this->getApiKey()) &&
            !empty($this->getUser()) && is_array($this->getUser()) && count($this->getUser()) > 0;
    }

    /**
     * @param $number
     * @return int
     */
    public function setNumberOfRecommendations($number)
    {
        return $this->numberOfRecommendations = $number;
    }

    /**
     * @return null|string creates the recommendation signature
     */
    public function createSignature()
    {
        // echo ("Invoking createSignature from BreinRecommendations");

        if (empty($this->getSecret())) {
            return null;
        } else {
            $message = sprintf("%d",$this->getUnixTimestamp());
            return base64_encode(hash_hmac('sha256', $message, $this->getSecret(), true));
        }
    }
}