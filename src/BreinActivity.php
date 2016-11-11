<?php
namespace Breinify\API;

use Breinify\API\libraries\BreinUtil;

/**
 * Class BreinActivity
 * @package Breinify\API
 */
class BreinActivity {

    private $apiKey = null;
    private $secret = null;
    private $unixTimestamp = null;
    private $user = null;
    private $activities = [];
    private $ipAddress = null;

    /**
     * BreinActivity constructor.
     */
    public function __construct() {
        $this->setUnixTimestamp(null);
    }

    /**
     * @param $user
     * @throws \Exception
     */
    public function setUser($user) {

        if (get_class($user) === 'Breinify\API\BreinUser') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->user = $user->data();
        } else if (is_array($user)) {
            $this->user = BreinUtil::filterArray($user, BreinUser::$validAttributes);
        } else {
            throw new \Exception('Invalid user type: ' . $user);
        }
    }

    /**
     * @param $unixTimestamp
     */
    public function setUnixTimestamp($unixTimestamp) {
        $this->unixTimestamp = $unixTimestamp == null ? time() : $unixTimestamp;
    }

    /**
     * An activity has the fields type, description, and tags.
     *
     * @param $type
     * @param null $description the description of the activity
     * @param null $category the category of the activity
     * @param null $tags comma-separated list of tags
     * @return array $activity an array containing the activity to be added
     */
    public function addActivity($type, $category = null, $description = null, $tags = null) {
        return array_push($this->activities, [
            'type'        => $type,
            'category'    => $category,
            'description' => $description,
            'tags'        => (is_array($tags) ? implode(',', $tags) : $tags)
        ]);
    }

    /**
     * @return null
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getActivities() {
        return $this->activities;
    }

    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * @return null
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @return null
     */
    public function getUnixTimestamp() {
        return $this->unixTimestamp;
    }

    /**
     * @param $secret
     */
    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return null
     */
    public function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * @param null $ipAddress
     */
    public function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return array
     */
    public function data() {
        return [
            'user'          => $this->user,
            'activities'    => $this->activities,
            'apiKey'        => $this->apiKey,
            'unixTimestamp' => $this->unixTimestamp,
            'ipAddress'     => (empty($ipAddress) ? '' : $ipAddress)
        ];
    }

    /**
     * @param $data array
     * @return bool
     */
    public function setData($data) {

        // validate the data first
        if (is_array($data) &&
            (!empty($data['activities']) || !empty($data['activity'])) &&
            !empty($data['apiKey']) &&
            !empty($data['user'])
        ) {
            $this->user = $data['user'];
            $this->activities = (!empty($data['activities']) ? $data['activities'] : [$data['activity']]);
            $this->apiKey = $data['apiKey'];
            $this->unixTimestamp = empty($data['unixTimestamp']) ? $this->unixTimestamp : $data['unixTimestamp'];

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string encoded json data
     */
    public function json() {
        return json_encode($this->data());
    }

    /**
     * @return bool checks if BreinActivity contains valid data for further processing
     */
    public function isValid() {
        return !empty($this->apiKey) &&
        !empty($this->activities) && is_array($this->activities) && count($this->activities) > 0 &&
        !empty($this->user) && is_array($this->user) && count($this->user) > 0;
    }

    /**
     * @return null|string creates the activity signature
     */
    public function createSignature() {
        if (empty($this->secret)) {
            return null;
        } else {
            $activityLength = count($this->activities);
            $activity = count($this->activities) === 0 ? null : $this->activities[0];

            $message = sprintf("%s%d%d",
                empty($activity['type']) ? '' : $activity['type'],
                $this->unixTimestamp,
                $activityLength);

            return base64_encode(hash_hmac('sha256', $message, $this->secret, true));
        }
    }
}