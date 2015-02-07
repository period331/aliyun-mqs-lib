<?php
// baocaixiong 下午3:24

namespace Mqs;


trait Message
{
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
    public function getRawBody()
    {
        return $this->messageBody;
    }

    /**
     * @return int
     */
    public function getReceiptHandle()
    {
        return $this->receiptHandle;
    }

    /**
     * @return int
     */
    public function getDequeueCount()
    {
        return $this->dequeueCount;
    }
}