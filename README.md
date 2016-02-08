# brein-api-library-php

## A quick start
First of all, you have to have a valid api-Key (create an account and get your personal api-key at [Breinify.com]. In this example, we assume you have the following api-key:

**772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6**

To communicate with the Brein Engine utilizing the provided PHP library is as easy as this:

```php
require_once("lib-brein-engine.php");

$user = new \Breinify\API\PHP\BreinUser();
$user.setFirstName("Diane");
$user.setLastName("Keng");
$user.setEmail("diane.keng@breinify.com");

$activity = new \Breinify\API\PHP\BreinActivity();
$activity.setApiKey("772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6");
$activity.setUser($user);
$activity.setType("login");

\Breinify\API\PHP\BreinEngine::sendActivity($activity);
```

## A more detailed introduction

### Requirements
This library is used to integrate the Brein Engine (more specific, the API's end-points: activity and lookup) into a given PHP based web-platform. The documentation requires PHP 5 or higher.

### Communicating with the Brein Engine
The communication with the Brein Engine can be performed from back-end side, i.e.,:
* using file-streams (i.e., url-based file-streams must be supported, see [Environment and file-streams](#using-back-end-calls-utilizing-file-streams)), or
* using cURL (i.e., PHP cURL module available, see [Environment and cURL](#using-back-end-calls-utilizing-curl)).

In addition, the communication can also be performed through injected JavaScript on client-side.

In the former case, it is necessary that the PHP back-end infrastructure allows the communication with the Brein Engine (i.e., outgoing POST-traffic should not be blocked). In the latter case, the communication with the Brein Engine might be blocked by the client. Thus, we recommend the usage of a back-end to back-end communication based on file-streams or cURL.

## Troubleshooting

### Using back-end calls utilizing file-streams
If the communication between the back-end and the Brein Engine is performed with file-streams the back-end must fulfill the following requirements:
* POST calls to the Brein Engine must not be blocked by the firewall (i.e., outgoing traffic should be possible)
* the functions *stream_context_create* and *file_get_contents* must be available (which is the case by default since PHP 4.3.0, cf.: [PHP stream context documentation], [PHP file get contents documentation]),
* the ini-parameter *allow_url_fopen* must be set to ON in the *php.ini* (which is the default setting, cf.: [PHP file system documentation]), and
*     ; Whether to allow the treatment of URLs (like http:// or ftp://) as files.
      ; http://php.net/allow-url-fopen
      allow_url_fopen = On

### Using back-end calls utilizing cURL
If the communication between the back-end and the Brein Engine is performed using cURL the back-end must fulfill the following requirements:
* POST calls to the Brein Engine must not be blocked by the firewall (i.e., outgoing traffic should be possible)
* the [cURL] module must be available, i.e., the functions *curl_init*, *curl_setopt*, *curl_exec*, *curl_getinfo*, and *curl_close* must be available, and


[//]: # (reference links)
   [cURL]: <http://php.net/manual/en/book.curl.php>
   [PHP file system documentation]: <http://php.net/manual/en/filesystem.configuration.php>
   [PHP file get contents documentation]: <http://php.net/manual/en/function.file-get-contents.php>
   [PHP stream context documentation]: <http://php.net/manual/en/function.stream-context-create.php>
   [Breinify.com]: <http://www.breinify.com>

