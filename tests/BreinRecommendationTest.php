<?php

use Breinify\API\BreinUser;
use Breinify\API\BreinEngine;
use Breinify\API\BreinRecommendation;

class BreinRecommendationTest extends PHPUnit_Framework_TestCase {

    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest() {
        error_log("Running testRecommendationDataRequest");
        $recommendation = new BreinRecommendation;
        $user = new BreinUser;
        $engine = new BreinEngine;

        $user->setEmail("philipp@meisen.net");

        $recommendation->setUser($user);
        $recommendation->setApiKey("7E19-7F47-2509-4CD2-9A9F-7C20-FC2B-XXXX");

        $engine->setType("curl");
        $result = $engine->performRecommendation($recommendation);
        error_log("result is: ");
        error_log(print_r($result),1);
    }

}