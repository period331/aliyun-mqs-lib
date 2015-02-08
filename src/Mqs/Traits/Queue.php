<?php
// baocaixiong 下午2:55

namespace Mqs\Traits;


trait Queue
{
    use Object;

    public $attributes = [];

    protected $activeMessages = -1;

    protected $createTime = -1;

    protected $delayMessages = -1;

    protected $delaySeconds = -1;

    protected $inactiveMessages = -1;

    protected $lastModifyTime = -1;

    protected $maximumMessageSize = -1;

    protected $messageRetentionPeriod = -1;

    protected $pollingWaitSeconds = -1;

    protected $queueName = '';

    protected $visibilityTimeout = -1;

    protected $queueURL = '';

    /**
     * @return int
     */
    public function getActiveMessages()
    {
        return $this->activeMessages;
    }

    /**
     * @param int $activeMessages
     * @return $this
     */
    public function setActiveMessages($activeMessages)
    {
        $this->activeMessages = $activeMessages;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param int $createTime
     * @return $this
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelayMessages()
    {
        return $this->delayMessages;
    }

    /**
     * @param int $delayMessages
     * @return $this
     */
    public function setDelayMessages($delayMessages)
    {
        $this->delayMessages = $delayMessages;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelaySeconds()
    {
        return $this->delaySeconds;
    }

    /**
     * @param int $delaySeconds
     * @return $this
     */
    public function setDelaySeconds($delaySeconds)
    {
        $this->delaySeconds = $delaySeconds;

        return $this;
    }

    /**
     * @return int
     */
    public function getInactiveMessages()
    {
        return $this->inactiveMessages;
    }

    /**
     * @param int $inactiveMessages
     * @return $this
     */
    public function setInactiveMessages($inactiveMessages)
    {
        $this->inactiveMessages = $inactiveMessages;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastModifyTime()
    {
        return $this->lastModifyTime;
    }

    /**
     * @param int $lastModifyTime
     * @return $this
     */
    public function setLastModifyTime($lastModifyTime)
    {
        $this->lastModifyTime = $lastModifyTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaximumMessageSize()
    {
        return $this->maximumMessageSize;
    }

    /**
     * @param int $maximumMessageSize
     * @return $this
     */
    public function setMaximumMessageSize($maximumMessageSize)
    {
        $this->maximumMessageSize = $maximumMessageSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getMessageRetentionPeriod()
    {
        return $this->messageRetentionPeriod;
    }

    /**
     * @param int $messageRetentionPeriod
     * @return $this
     */
    public function setMessageRetentionPeriod($messageRetentionPeriod)
    {
        $this->messageRetentionPeriod = $messageRetentionPeriod;

        return $this;
    }

    /**
     * @return int
     */
    public function getPollingWaitSeconds()
    {
        return $this->pollingWaitSeconds;
    }

    /**
     * @param int $pollingWaitSeconds
     * @return $this
     */
    public function setPollingWaitSeconds($pollingWaitSeconds)
    {
        $this->pollingWaitSeconds = $pollingWaitSeconds;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     * @return $this
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;

        return $this;
    }

    /**
     * @return int
     */
    public function getVisibilityTimeout()
    {
        return $this->visibilityTimeout;
    }

    /**
     * @param int $visibilityTimeout
     * @return $this
     */
    public function setVisibilityTimeout($visibilityTimeout)
    {
        $this->visibilityTimeout = $visibilityTimeout;

        return $this;
    }

    /**
     * @return string
     */
    public function getQueueURL()
    {
        return $this->queueURL;
    }

    /**
     * @param string $queueURL
     * @return $this
     */
    public function setQueueURL($queueURL)
    {
        $this->queueURL = $queueURL;

        return $this;
    }
}