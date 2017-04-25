>
```PHP
$user = new BreinUser();
$user->setSessionId("Rg3vHJZnehYLjVg7qi3bZjzg");
$user->setEmail("max@sample.net");
>
$activity = new BreinActivity();
$activity->setUser($user);
$activity->addActivity("pageVisit", "", "");      
$activity->setUser($user);
>
// tag map
$tagMap = array();
$tagMap["productId"] ="123689";
$tagMap["productPrice"] = 134.23;
>
$activity->setTags($tagMap);
>
$engine = new BreinEngine();
$result = $engine->sendActivity($activity);
```