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
     * @var String contains optional category
     */
    private $category;

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

        // optional field(s)
        if (!empty($this->getCategory())) {
            $recommendationFields['recommendationCategory'] = $this->getCategory();
        }

        // mandatory field
        $recommendationFields['numRecommendations'] = $this->numberOfRecommendations;
        $requestData['recommendation'] = $recommendationFields;

        // echo("\n content of recommendation-data is: \n");
        // echo(print_r($requestData,1));

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
            !empty($this->getUser());
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
     * @return String the category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param String $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return null|string creates the activity signature
     */
    public function createSignature()
    {
        // echo ("Invoking createSignature from BreinRecommendations");

        if (empty($this->getSecret())) {
            return null;
        } else {
            $message = sprintf("%d", $this->getUnixTimestamp());

            return base64_encode(hash_hmac('sha256', $message, $this->getSecret(), true));
        }
    }
}