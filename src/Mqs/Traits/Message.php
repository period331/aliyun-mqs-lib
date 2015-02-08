<?php
// baocaixiong 下午3:24

namespace Mqs\Traits;


trait Message
{
    use Object;

    public $attributes = [];

    /**
     * @var string
     */
    protected $messageBody;

    /**
     * 延迟时间
     *
     * @var int
     */
    protected $delaySeconds = -1;

    /**
     * 优先级
     *
     * @var int
     */
    protected $priority = -1;

    /**
     * 调用次数
     *
     * @var int
     */
    protected $dequeueCount = -1;

    /**
     * 下次执行时间
     *
     * @var int
     */
    protected $nextVisibleTime = -1;

    /**
     * 首次执行时间
     *
     * @var int
     */
    protected $firstDequeueTime = -1;

    /**
     * 入队时间
     *
     * @var int
     */
    protected $enqueueTime = -1;

    /**
     * @var string
     */
    protected $receiptHandle = '';

    /**
     * @var string
     */
    protected $messageBodyMD5 = '';

    /**
     * @var int
     */
    protected $messageId = -1;

    /**
     * @return string
     */
    public function getMessageBody()
    {
        return $this->messageBody;
    }

    /**
     * @param string $messageBody
     * @return $this
     */
    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;

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
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int
     */
    public function getDequeueCount()
    {
        return $this->dequeueCount;
    }

    /**
     * @param int $dequeueCount
     * @return $this
     */
    public function setDequeueCount($dequeueCount)
    {
        $this->dequeueCount = $dequeueCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getNextVisibleTime()
    {
        return $this->nextVisibleTime;
    }

    /**
     * @param int $nextVisibleTime
     * @return $this
     */
    public function setNextVisibleTime($nextVisibleTime)
    {
        $this->nextVisibleTime = $nextVisibleTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getFirstDequeueTime()
    {
        return $this->firstDequeueTime;
    }

    /**
     * @param int $firstDequeueTime
     * @return $this
     */
    public function setFirstDequeueTime($firstDequeueTime)
    {
        $this->firstDequeueTime = $firstDequeueTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getEnqueueTime()
    {
        return $this->enqueueTime;
    }

    /**
     * @param int $enqueueTime
     * @return $this
     */
    public function setEnqueueTime($enqueueTime)
    {
        $this->enqueueTime = $enqueueTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptHandle()
    {
        return $this->receiptHandle;
    }

    /**
     * @param string $receiptHandle
     * @return $this
     */
    public function setReceiptHandle($receiptHandle)
    {
        $this->receiptHandle = $receiptHandle;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageBodyMD5()
    {
        return $this->messageBodyMD5;
    }

    /**
     * @param string $messageBodyMD5
     * @return $this
     */
    public function setMessageBodyMD5($messageBodyMD5)
    {
        $this->messageBodyMD5 = $messageBodyMD5;

        return $this;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     * @return $this
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

}