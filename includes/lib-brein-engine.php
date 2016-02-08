<?php

namespace Breinify\API\PHP;

require_once("classes/BreinifyUser.php");
require_once("classes/BreinifyActivity.php");
require_once("classes/BreinifyLookUp.php");

class BreinEngine {

    public static function sendActivity($activity) {

    }

    public static function performLookUp($lookUp) {

    }

    private static function doCurl($url, $data) {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = json_decode(curl_exec($curl), true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return ['status' => $status, 'response' => $response];
    }

    private static function doFileGetContents($url, $data) {

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header'  => "Content-type: application/json",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $status = $result === false ? 500 : 200;

        return ['status' => $status, 'response' => json_decode($result, true)];
    }
}