<?php

use Breinify\API\BreinEngine;
use Breinify\API\BreinTemporalData;
use Breinify\API\BreinUser;
use Breinify\API\Breinify;

class BreinifyTempralDataTest extends PHPUnit_Framework_TestCase
{

    public static $API_KEY = "- HAS TO BE A VALID KEY -";

    public static $API_KEY_WITH_SECRET = "- HAS TO BE A VALID KEY FOR SECRET -";

    public static $SECRET  = "- HAS TO BE A VALID SECRET -";

    /**
     * Testcase of temporaldata request
     *
     */
    public function testTemporalDataRequest()
    {
        echo("\nRunning testTemporalDataRequest\n");
        $temporalData = new BreinTemporalData;
        $user = new BreinUser;
        $engine = new BreinEngine;

        $user->setFirstName("Toni");
        $user->setLastName("Maroni");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setEmail("toni@maroni.net");

        // additional fields
        $user->setReferrer("10.11.12.130");
        $user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user->setTimezone("America/Los_Angeles");

        $temporalData->setUser($user);
        $temporalData->setIpAddress("134.201.250.155");
        $temporalData->setApiKey(BreinifyTempralDataTest::$API_KEY);

        $result = $engine->temporalData($temporalData);
        $this->assertEquals(200, $result["status"]);

        echo("\nresult is: " . var_dump($result));
        echo("\n=========== END TEST =============\n");
    }


    /**
     * Testcase of temporaldata request
     *
     */
    public function testTemporalDataRequestWithBreinifyExecutor()
    {
        echo("\nRunning testTemporalDataRequestWithBreinifyExecutor \n");
        $user = new BreinUser;
        $user->setEmail("toni@maroni.net");

        // additional fields
        // $user->setReferrer("10.11.12.130");
        $user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user->setTimezone("America/Los_Angeles");

        $breinify = new Breinify(BreinifyActivityTest::$API_KEY);

        $temporalData = new BreinTemporalData;
        $temporalData->setUser($user);

        $result = $breinify->temporalData($temporalData);
        $this->assertEquals(200, $result["status"]);

        echo("result is: " . var_dump($result));
        echo("\n=========== END TEST =============\n");
    }


}