<?php
namespace Breinify\API;

/**
 * Class BreinActivity
 * @package Breinify\API
 */
class BreinActivity extends BreinBase
{
    /**
     * contains an array of activity fields
     *
     * @var array of activity fields
     */
    private $activities = [];

    /**
     * @var array $activityMap with additional fields on activity level
     */
    private $activityMap = array();

    /**
     * the tagsArray
     * @var array of tags
     *
     */
    private $tags = array();

    /**
     * An activity has the fields type, description, and tags.
     *
     * @param $type string
     * @param string $description the description of the activity
     * @param string $category the category of the activity
     * @param string $tags comma-separated list of tags
     * @return array $activity an array containing the activity to be added
     */
    public function addActivity($type, $category = null, $description = null, $tags = null)
    {
        return array_push($this->activities, [
            'type' => $type,
            'category' => $category,
            'description' => $description,
            'tags' => (is_array($tags) ? implode(',', $tags) : $tags)
        ]);
    }

    /**
     * @return array of activities
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * creates the data request
     *
     * @return array
     */
    public function data()
    {
        $requestData = parent::data();

        // check to see if any additinal activity fields are set
        if (!empty($this->get())) {
            $requestData['activity'] = $this->get();
        }

        // field name must be 'activities' in case of multiple activities
        // otherwise call it 'activity' if you can ensure that only one will
        // be sent.
        $requestData['activities'] = $this->activities;

        if (!empty($this->ipAddress)) {
            $requestData['ipAddress'] = $this->ipAddress;
        }

        if (!empty($this->getSecret())) {
            $requestData['signature'] = $this->createSignature();
        }

        // check to see if any tags are set
        if (!empty($this->getTags())) {
            $requestData['tags'] = $this->getTags();
        }

        // echo("content of activity-data is: ");
        // echo(print_r($requestData), 1);

        return $requestData;
    }

    /**
     * @param $data array
     * @return bool
     */
    public function setData($data)
    {
        // validate the data first
        if (is_array($data) &&
            (!empty($data['activities']) || !empty($data['activity'])) &&
            !empty($data['apiKey']) &&
            !empty($data['user'])
        ) {
            $this->setUser($data['user']);
            $this->activities = (!empty($data['activities']) ? $data['activities'] : [$data['activity']]);
            $this->setApiKey($data['apiKey']);
            $this->setUnixTimestamp(empty($data['unixTimestamp']) ? $this->getUnixTimestamp() : $data['unixTimestamp']);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string encoded json data
     */
    public function json()
    {
        return json_encode($this->data());
    }

    /**
     * @return bool checks if BreinActivity contains valid data for further processing
     */
    public function isValid()
    {
        return !empty($this->getApiKey()) &&
            !empty($this->activities) && is_array($this->activities) && count($this->activities) > 0 &&
            !empty($this->getUser()) && is_array($this->getUser()) && count($this->getUser()) > 0;
    }

    /**
     * @return null|string creates the activity signature
     */
    public function createSignature()
    {
        // echo("Invoking createSignature from BreinActivity");
        if (empty($this->getSecret())) {
            return null;
        } else {
            $activityLength = count($this->activities);
            $activity = count($this->activities) === 0 ? null : $this->activities[0];

            $message = sprintf("%s%d%d",
                empty($activity['type']) ? '' : $activity['type'],
                $this->getUnixTimestamp(),
                $activityLength);

            return base64_encode(hash_hmac('sha256', $message, $this->getSecret(), true));
        }
    }

    /**
     * sets the tags array
     * @param $tagMap array contains the tagsArray
     */
    public function setTags($tagMap)
    {
        $this->tags = $tagMap;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->activityMap;
    }

    /**
     * @param array $activityMap
     */
    public function set($activityMap)
    {
        $this->activityMap = $activityMap;
    }
}