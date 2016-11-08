<?php

namespace Breinify\API;

class BreinEngine {

    private static $baseUrl = "https://api.breinify.com";
    private static $type = null;
    private static $validTypes = ["curl" => "doCurl", "stream" => "doFileGetContents"];

    public static function sendActivity($activity) {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/activity", $activity->data());
    }

    public static function temporalData($temporalData) {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/temporaldata", $temporalData->data());
    }

    public static function performLookUp($lookUp) {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/lookup", $lookUp);
    }

    public static function setType($type) {
        $normType = strtolower($type);

        if (array_key_exists($normType, BreinEngine::$validTypes)) {
            BreinEngine::$type = strtolower($normType);
        } else {
            throw new \Exception("The type '$type' is not supported by the system.");
        }
    }

    private static function execute($url, $data) {
        $class = __NAMESPACE__ . "\\BreinEngine";
        $method = BreinEngine::selectType();

        return $class::$method($url, $data);
    }

    private static function selectType() {
        if (BreinEngine::$type === null) {
            if (function_exists('stream_context_create') && function_exists('file_get_contents') && BreinEngine::isIniSet('allow_url_fopen')) {
                return BreinEngine::$validTypes["stream"];
            } else if (function_exists('curl_init')) {
                return BreinEngine::$validTypes["curl"];
            } else {
                throw new \Exception("Unable to find any valid method to communicate with the BreinEngine.");
            }
        } else {
            return BreinEngine::$validTypes[BreinEngine::$type];
        }
    }

    private static function isIniSet($setting) {
        $value = ini_get($setting);

        if ((int)$value > 0) {
            return true;
        } else {
            $lowerValue = strtolower($value);

            return ($lowerValue === "true" || $lowerValue === "on" || $lowerValue === "yes");
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    /**
     * Sends data via POST using the cUrl implementation.
     *
     * @param $url string the url of the api to send the data to
     * @param $data mixed the data to be send
     * @return array the received information as associative array with 'status' (status-code of the response) and 'response' (the actual payload)
     */
    private static function doCurl($url, $data) {
        error_log("within doCurl");

        $data_string = json_encode($data);
        error_log("json_encode is: ");
        error_log($data_string);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $response = json_decode(curl_exec($curl), true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        error_log("HTTP-Status is: ");
        error_log($status);

        curl_close($curl);

        return ['status' => $status, 'response' => $response];
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    /**
     * Sends data via POST using the file_get_contents implementation.
     *
     * @param $url string the url of the api to send the data to
     * @param $data mixed the data to be send
     * @return array the received information as associative array with 'status' (status-code of the response) and 'response' (the actual payload)
     */
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