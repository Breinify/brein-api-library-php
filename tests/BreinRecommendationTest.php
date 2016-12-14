<?php

use Breinify\API\BreinEngine;
use Breinify\API\BreinRecommendation;
use Breinify\API\BreinRecommendationResult;
use Breinify\API\BreinUser;

class BreinRecommendationTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest()
    {

        echo "\n";
        echo "TEST \n\n";
        echo "TEST \n\n";

        error_log("=========== START TEST =============");
        error_log("Running testRecommendationDataRequest");
        $recommendation = new BreinRecommendation;
        $user = new BreinUser;
        $engine = new BreinEngine;

        $user->setEmail("sola@thedog.com");

        $recommendation->setUser($user);
        $recommendation->setApiKey("2514-2506-68B1-45C3-8DCC-B8B8-32D4-9870");
        $recommendation->setNumberOfRecommendations(10);

        $result = $engine->performRecommendation($recommendation);
        $recResult = new BreinRecommendationResult($result);

        $status = $recResult->getStatus();

        if ($status == 200) {

            echo "\n Status from BreinRecommendationResult is: " . $recResult->getStatus();
            echo "\n Message from BreinRecommendationResult is: " . $recResult->getMessage();

            // loop over results
            foreach ($recResult->getResults() as $value) {
                echo "\n Result is: " . print_r($value, true);
            }

        }

        echo "\n";
        echo "\n";
        echo "=========== END TEST =============";
    }


}