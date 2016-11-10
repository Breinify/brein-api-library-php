<?php

use Breinify\API\BreinActivity;
use Breinify\API\BreinUser;
use Breinify\API\BreinEngine;
use Breinify\API\BreinUserAdditional;
use Breinify\API\BreinTemporalData;

class BreinifyTempralDataTest extends PHPUnit_Framework_TestCase {

    /**
     *
     */
    public function testTemporalDataRequest() {
        error_log("Running testTemporalDataRequest");
        $temporalData = new BreinTemporalData;
        $user = new BreinUser;
        $user_additional = new BreinUserAdditional;
        $engine = new BreinEngine;


        $user->setFirstName("Toni");
        $user->setLastName("Maroni");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setEmail("toni@maroni.net");

        // additional
        $user_additional->setReferrer("10.11.12.130");
        $user_additional->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user_additional->setTimezone("America/Los_Angeles");
        $user->setUserAdditional($user_additional);

        $temporalData->setUser($user);
        $temporalData->setApiKey("41B2-F48C-156A-409A-B465-317F-A0B4-E0E8");
        $output = print_r($temporalData->data(),1);

        $engine->setType("curl");
        $result = $engine->temporalData($temporalData);
        error_log("result is: ");
        error_log(print_r($result),1);
    }

    /**
     *
     */
    public function testTemporalDataRequestWithSecret() {
        error_log("Running testTemporalDataRequestWithSecret");
        $temporalData = new BreinTemporalData();
        $user = new BreinUser();
        $user_additional = new BreinUserAdditional();
        $engine = new BreinEngine();


        $user->setFirstName("Toni");
        $user->setLastName("Maroni");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setEmail("toni@maroni.net");

        // additional
        $user_additional->setReferrer("10.11.12.130");
        $user_additional->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
        $user_additional->setTimezone("America/Los_Angeles");
        $user->setUserAdditional($user_additional);

        $temporalData->setUser($user);
        $temporalData->setApiKey("lmcoj4k27hbbszzyiqamhg==");
        $temporalData->setSecret("CA8A-8D28-3408-45A8-8E20-8474-06C0-8548");

        $engine->setType("curl");
        $result = $engine->temporalData($temporalData);
        error_log("result is: ");
        error_log(print_r($result),1);
    }

}