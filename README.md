# brein-api-library-php
This library is used to integrate the Brein Engine (more specific, the API's end-points: activity and lookup) into a given PHP based web-platform. The documentation requires:
* at least PHP 5 or larger,
* ...

The communication with the Brein Engine can be performed from back-end side, i.e.,:
* using file-streams (i.e., url-based file-streams must be supported, see ), or
* using cURL (i.e., PHP cURL module available, see [Environment](#Environment)).

The communication can also be performed through injected JavaScript on client-side.
In the former case, it is necessary that the PHP back-end infrastructure allows the communication with the Brein Engine (i.e., outgoing POST-traffic should not be blocked). In the latter case, the communication with the Brein Engine might be blocked by the client. Thus, we recommend the usage of a back-end to back-end communication.

## Environment
### Using back-end calls utilizing file-streams

### Using back-end calls utilizing cURL
[cURL]

[//]: # (reference links)
   [cURL]: <http://php.net/manual/en/book.curl.php>

