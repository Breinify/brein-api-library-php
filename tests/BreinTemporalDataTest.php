<?php

use Breinify\API\BreinUser;
use Breinify\API\BreinEngine;
use Breinify\API\BreinTemporalData;

class BreinifyTempralDataTest extends PHPUnit_Framework_TestCase {

    /**
     * Testcase of temporaldata request
     */
    public function testTemporalDataRequest() {
        error_log("Running testTemporalDataRequest");
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
        $temporalData->setApiKey("41B2-F48C-156A-409A-B465-317F-A0B4-E0E8");

        $result = $engine->temporalData($temporalData);
        error_log("result is: ");
        error_log(print_r($result),1);
        error_log("=======================");
    }

    /**
     * Testcase of temporaldata request with secret
     */
    public function testTemporalDataRequestWithSecret() {
        error_log("Running testTemporalDataRequestWithSecret");
        $temporalData = new BreinTemporalData;
        $user = new BreinUser;
        $engine = new BreinEngine;

        $user->setFirstName("Toni");
        $user->setLastName("Maroni");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setEmail("toni@maroni.net");

        // additional
        $user->setReferrer("10.11.12.130");
        $user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user->setTimezone("America/Los_Angeles");

        $temporalData->setIpAddress("134.201.250.155");
        $temporalData->setUser($user);
        $temporalData->setSecret("lmcoj4k27hbbszzyiqamhg==");
        $temporalData->setApiKey("CA8A-8D28-3408-45A8-8E20-8474-06C0-8548");

        $result = $engine->temporalData($temporalData);
        error_log("result is: ");
        error_log(print_r($result),1);

        $response[] = $result['response'];
        error_log("RESPONSE IS: " . print_r($response),1);

        error_log("=======================");
    }

}