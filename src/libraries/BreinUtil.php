<?php
namespace Breinify\API\libraries;

class BreinUtil
{
    /**
     * Method used to filter an array based on keys.
     *
     * @param $toBeFiltered array the associative array to be filtered
     * @param $keys array the keys to remain in the array
     * @return array the filtered array
     */
    public static function filterArray($toBeFiltered, $keys)
    {
        $result = [];

        foreach ($toBeFiltered as $key => $value) {
            if (in_array($key, $keys)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
