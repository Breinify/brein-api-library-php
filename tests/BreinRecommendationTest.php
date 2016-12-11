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

        $user->setEmail("sola@example.com");

        $recommendation->setUser($user);
        $recommendation->setApiKey("time-is-ticking");
        $recommendation->setSecret("time-rift");

        $recommendation->setApiKey("CA8A-8D28-3408-45A8-8E20-8474-06C0-8548");
        $recommendation->setSecret("lmcoj4k27hbbszzyiqamhg==");

        $recommendation->setNumberOfRecommendations(10);

        $result = $engine->performRecommendation($recommendation);
        error_log("result is: ");
        error_log(print_r($result),1);
        error_log("=======================");
    }


    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest2() {
        error_log("Running testRecommendationDataRequest");
        $recommendation = new BreinRecommendation;
        $recommendation->setApiKey("CA8A-8D28-3408-45A8-8E20-8474-06C0-8548");
        $recommendation->setSecret("lmcoj4k27hbbszzyiqamhg==");
        $recommendation->setNumberOfRecommendations(10);

        $user = new BreinUser;
        $user->setEmail("sola@example.com");
        $user->setPhone("1122333");

        $recommendation->setUser($user);

        $engine = new BreinEngine;
        $result = $engine->performRecommendation($recommendation);
        error_log("result is: ");
        error_log(print_r($result),1);
        error_log("=======================");
    }

}