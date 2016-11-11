<?php

use Breinify\API\BreinActivity;
use Breinify\API\BreinUser;
use Breinify\API\BreinEngine;
use Breinify\API\BreinUserAdditional;

class BreinifyActivityTest extends PHPUnit_Framework_TestCase {


    public function infoTest() {
    /*
        $w = stream_get_wrappers();
        $openssl = extension_loaded('openssl') ? 'yes':'no';
        $http_wrapper = in_array('http', $w) ? 'yes':'no';
        $https_wrapper = in_array('https', $w) ? 'yes':'no';
        $wrappers = var_export($w);

        error_log("$w: "); error_log($w);
        error_log("$openssl: "); error_log($openssl);
        error_log("$http_wrapper: "); error_log($http_wrapper);
        error_log("$https_wrapper: "); error_log($https_wrapper);
        error_log("$wrappers: "); error_log($wrappers);
    */
    }

    /**
     * Tests if the data is set correctly.
     */
    public function test_that_data_is_set_correctly() {
        $activity = new BreinActivity();

        $activityArray = json_decode(preg_replace( "/[ ]{2,}|[\t]|\r|\n/", "",
            "{
              \"user\": {
                \"email\": \"philipp@wherever.com\",
                \"firstName\": \"Philipp\",
                \"lastName\": \"Meisen\",
                \"dateOfBirth\": \"01/20/1981\",
                \"sessionId\": \"Rg3vHJZnehYLjVg7qi3bZjzg\",
                \"deviceId\": \"f07a13984f6d116a\",
                \"imei\": \"990000862471854\"
              },

              \"activity\": {
                \"type\": \"search\",
                \"description\": \"brownies recipe\",
                \"tags\": \"food, recipe, valid customer\"
              },

              \"apiKey\": \"5d8b-064c-f007-4f92-a8dc-d06b-56b4-fad8\",
              \"unixTimestamp\": 1451962516,
              \"signatureType\": \"HmacSHA256\"
            }"), true);

        // set data
        $this->assertTrue($activity->setData($activityArray));

        // now validate the signature algorithm
        $this->assertEquals("5d8b-064c-f007-4f92-a8dc-d06b-56b4-fad8", $activity->getApiKey());
        $this->assertEquals(1451962516, $activity->getUnixTimestamp());

        $this->assertEquals(1, count($activity->getActivities()));
        $this->assertEquals("search", $activity->getActivities()[0]["type"]);
        $this->assertEquals("brownies recipe", $activity->getActivities()[0]["description"]);
        $this->assertEquals("food, recipe, valid customer", $activity->getActivities()[0]["tags"]);

        $this->assertEquals("philipp@wherever.com", $activity->getUser()["email"]);
        $this->assertEquals("Philipp", $activity->getUser()["firstName"]);
        $this->assertEquals("Meisen", $activity->getUser()["lastName"]);
        $this->assertEquals("01/20/1981", $activity->getUser()["dateOfBirth"]);
        $this->assertEquals("Rg3vHJZnehYLjVg7qi3bZjzg", $activity->getUser()["sessionId"]);
        $this->assertEquals("f07a13984f6d116a", $activity->getUser()["deviceId"]);
        $this->assertEquals("990000862471854", $activity->getUser()["imei"]);
    }

    /**
     * Tests if the data from a BreinifyUser is read correctly.
     */
    public function test_that_user_data_is_read_from_BreinifyUser() {
        $activity = new BreinActivity();
        $user = new BreinUser();

        $user->setFirstName("Tobias");
        $user->setLastName("Meisen");
        $user->setImei("990000862471854");
        $user->setDeviceId("9XXXX862YUJK19");
        $user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
        $user->setEmail("tobias@brother.net");

        $activity->setUser($user);

        $this->assertEquals("tobias@brother.net", $activity->getUser()["email"]);
        $this->assertEquals("Tobias", $activity->getUser()["firstName"]);
        $this->assertEquals("Meisen", $activity->getUser()["lastName"]);
        $this->assertEquals("990000862471854", $activity->getUser()["imei"]);
        $this->assertEquals("9XXXX862YUJK19", $activity->getUser()["deviceId"]);
        $this->assertEquals("Rg3vHJZnehYLjVg7qi3bZjzg", $activity->getUser()["sessionId"]);
    }

    /**
     * Tests if the created signature for an activity is correct.
     */
    public function test_that_signature_is_correct() {
        $activity = new BreinActivity();

        $activityArray = json_decode(preg_replace( "/[ ]{2,}|[\t]|\r|\n/", "",
            "{
              \"user\": {
                \"email\": \"philipp@meisen.net\",
                \"firstName\": \"Philipp\",
                \"lastName\": \"Meisen\",
                \"dateOfBirth\": \"01/20/1981\",
                \"sessionId\": \"Rg3vHJZnehYLjVg7qi3bZjzg\",
                \"deviceId\": \"f07a13984f6d116a\",
                \"imei\": \"990000862471854\"
              },

              \"activity\": {
                \"type\": \"search\",
                \"description\": \"brownies recipe\",
                \"tags\": \"food, recipe, valid customer\"
              },

              \"apiKey\": \"5d8b-064c-f007-4f92-a8dc-d06b-56b4-fad8\",
              \"unixTimestamp\": 1451962516
            }"), true);
        $activity->setSecret("5e9xqoesiygkuzddxjlkaq==");

        // the data should be accepted as valid data
        $this->assertTrue($activity->setData($activityArray));

        // now validate the signature algorithm
        $this->assertEquals("rsXU0ozhfzieNLA2jQs2h2e4sz2+qHGxbgSYyfWr5EM=",
            $activity->createSignature());
    }

    /**
     * Testcase of login activity request
     */
    public function testLoginRequest() {
        $activity = new BreinActivity;
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

        $user->setUserAdditional($user_additional);

        $activity->setUser($user);
        $activity->setApiKey("41B2-F48C-156A-409A-B465-317F-A0B4-XXXX");
        $activity->addActivity("login", "food", "message of blub");

        $engine->setType("curl");
        $result = $engine->sendActivity($activity);
        error_log("result is: ");
        error_log(print_r($result,1));
    }

    /**
     * Testcase of login activity request using streams
     */
    public function testLoginWithStreamImplementationRequest() {

        /*
        $activity = new BreinActivity;
        $user = new BreinUser;
        $engine = new BreinEngine;

        $user->setEmail("toni@maroni.net");
        $activity->setUser($user);
        $activity->setApiKey("41B2-F48C-156A-409A-B465-317F-A0B4-E0E8");
        $activity->addActivity("login", "food", "message of blub");

        BreinEngine::setType("stream");
        $result = $engine->sendActivity($activity);
        error_log("result is: ");
        error_log(print_r($result,1));
        */
    }

}