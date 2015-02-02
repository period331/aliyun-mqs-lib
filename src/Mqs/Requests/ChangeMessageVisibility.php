<?php
// baocaixiong 下午4:33

namespace Mqs\Requests;


class ChangeMessageVisibility extends BaseRequest
{
    protected $urlParams = [
        'ReceiptHandle' => -1,
        'VisibilityTimeout' => -1
    ];

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
}