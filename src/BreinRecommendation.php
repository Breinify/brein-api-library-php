<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

/**
 * Class BreinRecommendation
 * @package Breinify\API
 */
class BreinRecommendation extends BreinBase
{

    /**
     * @var int $numberOfRecommendations contains the number of recommendations with default of 10
     */
    private $numberOfRecommendations = 10;

    /**
     * @var array of recommendation entries within the recommendation block
     */
    private $recommendations = array();

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

        error_log("content of recommendation-data is: ");
        error_log(print_r($requestData),1);

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
     * @return null|string creates the activity signature
     */
    public function createSignature() {

        error_log("Invoking createSignature from BreinRecommendations");

        if (empty($this->getSecret())) {
            return null;
        } else {
            $message = sprintf("%d%d",
                $this->getUnixTimestamp(),
                $this->numberOfRecommendations);

            return base64_encode(hash_hmac('sha256', $message, $this->getSecret(), true));
        }
    }
}