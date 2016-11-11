```php
$activity = new \Breinify\API\BreinActivity();
$activity.setApiKey("772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6");
$activity.setUser($user);
$activity.setType("login");
.
\Breinify\API\BreinEngine::setType("curl");
\Breinify\API\BreinEngine::sendActivity($activity);
```