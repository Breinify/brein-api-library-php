<p align="center">
  <img src="https://raw.githubusercontent.com/Breinify/brein-api-library-php/master/documentation/img/logo.png" alt="Breinify API PHP Library" width="250">
</p>

<p align="center">
Breinify's DigitalDNA API puts dynamic behavior-based, people-driven data right at your fingertips.
</p>


### Step By Step Introduction

#### What is Breinify's DigitialDNA

Breinify's DigitalDNA API puts dynamic behavior-based, people-driven data right at your fingertips. We believe that in many situations, a critical component of a great user experience is personalization. With all the data available on the web it should be easy to provide a unique experience to every visitor, and yet, sometimes you may find yourself wondering why it is so difficult.

Thanks to **Breinify's DigitalDNA** you are now able to adapt your online presence to your visitors needs and **provide a unique experience**. Let's walk step-by-step through a simple example.

## Quick start
### Step1: Configure the library

In order to use the library you need a valid API-key, which you can get for free at [https://www.breinify.com](https://www.breinify.com). In this example, we assume you have the following api-key:

**772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6**


```php
// configure the library
$apiKey = "772A-47D7-93A3-4EA9-9D73-85B9-479B-16C6";
$breinify = new \Breinify\API\Breinify($apiKey);

```

The Breinify object is now configured with a valid configuration.

#### Step 2: Start using the library

##### Placing activity triggers

The engine powering the DigitalDNA API provides two endpoints. The first endpoint is used to inform the engine about the activities performed by visitors of your site. The activities are used to understand the user's current interest and infer the intent. It becomes more and more accurate across different users and verticals as more activities are collected. It should be noted, that any personal information is not stored within the engine, thus each individual's privacy is well protected. The engine understands several different activities performed by a user, e.g., landing, login, search, item selection, or logout.



```php
// create a user 
$user = new \Breinify\API\BreinUser();
$user.setFirstName("Diane");
$user.setLastName("Keng");
$user.setEmail("diane.keng@breinify.com");

// create an activity
$activity = new \Breinify\API\BreinActivity();
$activity.setUser($user);
$activity->addActivity("login");

// send a request
$breinify->sendActivity($activity);

```

That's it!

##### Placing temporalData triggers

Temporal Intelligence API provides temporal triggers and visualizes patterns
enabling you to predict a visitor’s dynamic activities. Currently this will
cover:

* Current Weather
* Upcoming Holidays
* Time Zone
* Regional Events

They can be requested like this:

```php
// create a user 
$user = new \Breinify\API\BreinUser();
$user.setEmail("diane.keng@breinify.com");
$user->setLocalDateTime("Sun Dec 25 2016 18:15:48 GMT-0800 (PST)");
$user->setTimezone("America/Los_Angeles");

// create temporalData object and invoke the request
$temporalData = new \Breinify\API\BreinTemporalData();
$result = $breinify->temporalData($temporalData);

```





## A more detailed introduction

### Requirements
This library is used to integrate the Brein Engine (more specific, the API's end-points: activity and lookup) into a given PHP based web-platform. The library requires PHP 5 or higher.

### Communicating with the Brein Engine
The communication with the Brein Engine can be performed from back-end side, i.e.,:
* using file-streams (i.e., url-based file-streams must be supported, see [Environment and file-streams](#using-back-end-calls-utilizing-file-streams)), or
* using cURL (i.e., PHP cURL module available, see [Environment and cURL](#using-back-end-calls-utilizing-curl)).

In addition, the communication can also be performed through injected JavaScript on client-side.

In the former case, it is necessary that the PHP back-end infrastructure allows the communication with the Brein Engine (i.e., outgoing POST-traffic should not be blocked). In the latter case, the communication with the Brein Engine might be blocked by the client. Thus, we recommend the usage of a back-end to back-end communication based on file-streams or cURL.

## Troubleshooting

### Using back-end calls utilizing file-streams
If the communication between the back-end and the Brein Engine is performed with file-streams the back-end must fulfill the following requirements:
* POST calls to the Brein Engine must not be blocked by the firewall (i.e., outgoing traffic should be possible),
* the functions *stream_context_create* and *file_get_contents* must be available (which is the case by default since PHP 4.3.0, cf.: [PHP stream context documentation], [PHP file get contents documentation]), and
* the ini-parameter *allow_url_fopen* must be set to ON in the *php.ini* (which is the default setting, cf.: [PHP file system documentation])

### Using back-end calls utilizing cURL
If the communication between the back-end and the Brein Engine is performed using cURL the back-end must fulfill the following requirements:
* POST calls to the Brein Engine must not be blocked by the firewall (i.e., outgoing traffic should be possible), and
* the [cURL] module must be available, i.e., the functions *curl_init*, *curl_setopt*, *curl_exec*, *curl_getinfo*, and *curl_close* must be available.

[//]: # (reference links)
   [cURL]: <http://php.net/manual/en/book.curl.php>
   [PHP file system documentation]: <http://php.net/manual/en/filesystem.configuration.php>
   [PHP file get contents documentation]: <http://php.net/manual/en/function.file-get-contents.php>
   [PHP stream context documentation]: <http://php.net/manual/en/function.stream-context-create.php>
   [Breinify.com]: <https://www.breinify.com>
   
## IDE Configuration
Further information regarding the configuration of the IDE can be found [here](./documentation/devenv.md).

