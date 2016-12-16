<?php

namespace Breinify\API;

/**
 * Class BreinEngine
 * @package Breinify\API
 */
class BreinEngine
{

    /**
     * some constants
     */
    private static $baseUrl = "https://api.breinify.com";
    private static $type = "curl";
    private static $validTypes = ["curl" => "doCurl", "stream" => "doFileGetContents"];

    /**
     * BreinEngine constructor.
     * Default engine type is "curl"
     */
    public function __construct()
    {
        $this->setType("curl");
    }

    /**
     * @param $activity
     * @return mixed
     */
    public static function sendActivity($activity)
    {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/activity",
            $activity->data());
    }

    /**
     * @param $temporalData
     * @return mixed
     */
    public static function temporalData($temporalData)
    {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/temporaldata",
            $temporalData->data());
    }

    /**
     * @param $recommendation
     * @return mixed
     */
    public static function recommendation($recommendation)
    {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/recommendation",
            $recommendation->data());
    }

    /**
     * @param $lookUp
     * @return mixed
     */
    public static function performLookUp($lookUp)
    {
        return BreinEngine::execute(BreinEngine::$baseUrl . "/lookup", $lookUp);
    }

    /**
     * @param $type
     * @throws \Exception
     */
    public static function setType($type)
    {
        $normType = strtolower($type);

        if (array_key_exists($normType, BreinEngine::$validTypes)) {
            BreinEngine::$type = strtolower($normType);
        } else {
            throw new \Exception("The type '$type' is not supported by the system.");
        }
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    private static function execute($url, $data)
    {
        $class = __NAMESPACE__ . "\\BreinEngine";
        $method = BreinEngine::selectType();

        return $class::$method($url, $data);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    private static function selectType()
    {
        if (BreinEngine::$type === null) {
            if (function_exists('stream_context_create') && function_exists('file_get_contents') && BreinEngine::isIniSet('allow_url_fopen')) {
                return BreinEngine::$validTypes["stream"];
            } else if (function_exists('curl_init')) {
                return BreinEngine::$validTypes["curl"];
            } else {
                throw new \Exception("Unable to find any valid method to communicate with the BreinEngine.");
            }
        } else {
            // echo "Type is:";
            // echo BreinEngine::$validTypes[BreinEngine::$type];
            return BreinEngine::$validTypes[BreinEngine::$type];
        }
    }

    /**
     * @param $setting
     * @return bool
     */
    private static function isIniSet($setting)
    {
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
    private static function doCurl($url, $data)
    {

        $data_string = json_encode($data);
        // echo("\njson_encode is: ");
        // echo($data_string);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $headers = array('Accept: application/json', 'Content-Type: application/json');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        // echo("\ndoCurl: executing. ");
        // echo("\n  == >URL: " . $url);
        // echo("\n  == >Fields: " . $data_string . "\n");

        $response = json_decode(curl_exec($curl), true);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return ['status' => $status, 'result' => $response];
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    /**
     * Sends data via POST using the file_get_contents implementation.
     *
     * @param $url string the url of the api to send the data to
     * @param $data mixed the data to be send
     * @return array the received information as associative array with 'status' (status-code of the response) and 'response' (the actual payload)
     */
    private static function doFileGetContents($url, $data)
    {

        echo "Within doFileGetContents \n";
        echo " URL is : " . $url . "\n";
        echo " Data is: " . var_dump($data) . "\n";
;
        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/json",
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context = stream_context_create($options);
        echo " Context is: " . $context . "\n";

        $result = file_get_contents($url, false, $context);
        echo " Result is: " . $result . "\n";

        $status = $result === false ? 500 : 200;

        return ['status' => $status, 'response' => json_decode($result, true)];
    }

}