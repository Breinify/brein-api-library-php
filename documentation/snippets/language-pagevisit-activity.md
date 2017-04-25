>
```PHP
$user = new BreinUser();
$user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
$user->setEmail("max@sample.net");
>
$activity->setUser($user);
$activity->addActivity("pageVisit", "category-info", "description");
>
$result = $breinify->sendActivity($activity);
```