<?php
// baocaixiong 下午4:33

namespace Mqs\Requests;


class ChangeMessageVisibility extends BaseRequest
{
    protected $urlParams = [
        'ReceiptHandle' => '',
        'VisibilityTimeout' => -1
    ];

    protected $expectedStatus = 200;

    /**
     * @param string $queueName
     */
    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $this->requestResource = '/'.$queueName.'/messages';
    }

    /**
     * @param string $handler
     * @return $this
     */
    public function setReceiptHandle($handler)
    {
        $this->urlParams['ReceiptHandle'] = $handler;

        return $this;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setVisibilityTimeout($timeout)
    {
        $this->urlParams['VisibilityTimeout'] = $timeout;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptHandler()
    {
        return $this->urlParams['ReceiptHandle'];
    }

    /**
     * @return int
     */
    public function getVisibilityTimeout()
    {
        return $this->urlParams['VisibilityTimeout'];
    }
}