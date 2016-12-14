<?php

use Breinify\API\BreinRecommendation;
use Breinify\API\BreinUser;
use Breinify\API\Breinify;

class BreinRecommendationTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest()
    {
        echo("\n=========== START TEST =============");
        echo("Running testRecommendationDataRequest");

        // configuration
        $breinify = new Breinify("2514-2506-68B1-45C3-8DCC-B8B8-32D4-9870");

        // user
        $user = new BreinUser;
        $user->setEmail("sola@thedog.com");

        // recommendation
        $recommendation = new BreinRecommendation;
        $recommendation->setUser($user);
        $recommendation->setNumberOfRecommendations(10);

        // invoke request
        $recResult = $breinify->recommendation($recommendation);

        // result
        if ($recResult->getStatus() == 200) {

            echo "\n Status from BreinRecommendationResult is: " . $recResult->getStatus();
            echo "\n Message from BreinRecommendationResult is: " . $recResult->getMessage();

            // loop over results
            foreach ($recResult->getResults() as $value) {
                echo "\n Result is: " . print_r($value, true);
            }

        }

        echo "\n";
        echo "=========== END TEST =============";
    }


}