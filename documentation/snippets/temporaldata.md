```php
$temporalData = new \Breinify\API\BreinTemporalData;
$temporalData.setApiKey("772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6");
.
$user_additional = new \Breinify\API\BreinUserAdditional;
$user_additional->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
$user_additional->setTimezone("America/Los_Angeles");
.
$user = new \Breinify\API\BreinUser;
$user->setEmail("toni@maroni.net");
$user->setUserAdditional($user_additional);
.
$temporalData.setUser($user);
$temporalData->setApiKey("41B2-F48C-156A-409A-B465-317F-A0B4-E0E8");
.
$engine->setType("curl");
$result = $engine->temporalData($temporalData);
```
