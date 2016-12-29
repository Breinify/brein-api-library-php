```php
> // create a user 
> $user = new \Breinify\API\BreinUser();
> $user.setEmail("diane.keng@breinify.com");
> $user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
> $user->setTimezone("America/Los_Angeles");
> 
> // create temporalData object and invoke the request
> $temporalData = new \Breinify\API\BreinTemporalData();
> $result = $breinify->temporalData($temporalData);
```
