<?php

namespace Mqs\Requests;

class CreateQueue extends BaseRequest
{
    protected $payload = [
        'DelaySeconds' => 0,
        'MaximumMessageSize' => 65536,
        'MessageRetentionPeriod' => 345600,
        'VisibilityTimeout' => 30,
        'PollingWaitSeconds' => 0
    ];

    protected $method = 'PUT';

    /**
     * 204
     *
     * @var array
     */
    protected $expectedStatus = [201, 204];

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;

        $this->requestResource = '/'.$this->queueName;
    }

    /**
     * @param int $seconds
     * @return $this
     */
    public function setDelaySeconds($seconds = 0)
    {
        $this->payload['DelaySeconds'] = $seconds;

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setMaximumMessageSize($size = 65536)
    {
        $this->payload['MaximumMessageSize'] = $size;

        return $this;
    }

    public function setMessageRetentionPeriod($period = 345600)
    {
        $this->payload['MessageRetentionPeriod'] = $period;

        return $this;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setVisibilityTimeout($timeout = 30)
    {
        $this->payload['VisibilityTimeout'] = $timeout;

        return $this;
    }

    /**
     * @param int $seconds
     * @return $this
     */
    public function setPollingWaitSeconds($seconds = 0)
    {
        $this->payload['PollingWaitSeconds'] = $seconds;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelaySeconds()
    {
        return $this->payload['DelaySeconds'];
    }

    /**
     * @return int
     */
    public function getMaximumMessageSize()
    {
        return $this->payload['MaximumMessageSize'];
    }

    /**
     * @return int
     */
    public function getMessageRetentionPeriod()
    {
        return $this->payload['MessageRetentionPeriod'];
    }

    /**
     * @return int
     */
    public function getVisibilityTimeout()
    {
        return $this->payload['VisibilityTimeout'];
    }

    /**
     * @return int
     */
    public function getPollingWaitSeconds()
    {
        return $this->payload['PollingWaitSeconds'];
    }
}