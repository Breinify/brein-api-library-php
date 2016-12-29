```php
> // create a user 
> $user = new \Breinify\API\BreinUser();
> $user.setFirstName("Diane");
> $user.setLastName("Keng");
> $user.setEmail("diane.keng@breinify.com");
> 
> // create an activity
> $activity = new \Breinify\API\BreinActivity();
> $activity.setUser($user);
> $activity->addActivity("login");
> 
> // send a request
> $breinify->sendActivity($activity);
```