<?php
// baocaixiong 下午4:46

namespace Mqs\Requests;


class SetQueueAttributes extends BaseRequest
{
    protected $payload = [
        'DelaySeconds' => 0,
        'MaximumMessageSize' => 65536,
        'MessageRetentionPeriod' => 8,
        'VisibilityTimeout' => 30,
        'PollingWaitSeconds' => 0
    ];

    protected $method = 'PUT';

    protected $urlParams = [
        'metaoverride' => true
    ];

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
     * @param bool $bool
     * @return $this
     */
    public function setMetaOverride($bool)
    {
        $this->urlParams['metaoverride'] = $bool;

        return $this;
    }
}