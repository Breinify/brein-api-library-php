<?php

use Breinify\API\Breinify;
use Breinify\API\BreinRecommendation;
use Breinify\API\BreinUser;

class BreinRecommendationTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest()
    {
        echo "\n=========== START TEST =============\n";
        echo "Running testRecommendationDataRequest\n";

        // configuration
        $breinify = new Breinify("2514-2506-68B1-45C3-8DCC-B8B8-32D4-9870", "nd8ieprunt/kgkoe/3b0uw==");

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


    public function testRecommendationDataRequestComprehensive()
    {
        echo "\n=========== START TEST =============\n";
        echo "Running testRecommendationDataRequestComprehensive\n";
        // configuration
        $breinify = new Breinify("2514-2506-68B1-45C3-8DCC-B8B8-32D4-9870", "nd8ieprunt/kgkoe/3b0uw==");


        // user
        $user = new BreinUser;
        $user->setEmail("sola@thedog.com");
        $user->setFirstName("Sola");
        $user->setLastName("TheDog");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setPhone("+1 400 9000 222");

        // additional
        $user->setReferrer("10.11.12.130");
        $user->setUserAgent("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586");
        $user->setUrl("10.22.33.140");
        $user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user->setTimezone("America/Los_Angeles");
        $user->setIpAddress("74.115.209.58");

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


    /**
     * Testcase of recommendation request
     */
    public function testRecommendationDataRequest100Times()
    {
        echo "\n=========== START TEST =============\n";
        echo "Running testRecommendationDataRequest\n";

        // configuration
        $breinify = new Breinify("2514-2506-68B1-45C3-8DCC-B8B8-32D4-9870", "nd8ieprunt/kgkoe/3b0uw==");

        // user
        $user = new BreinUser;
        $user->setEmail("sola@thedog.com");

        // recommendation
        $recommendation = new BreinRecommendation;
        $recommendation->setUser($user);
        $recommendation->setNumberOfRecommendations(10);

        // invoke request

        for ($index = 1; $index < 2; $index++) {

            echo "Invoking: " . $index;

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
        }

        echo "\n";
        echo "=========== END TEST =============";
    }


}