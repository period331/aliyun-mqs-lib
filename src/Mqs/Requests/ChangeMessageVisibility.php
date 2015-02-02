<?php
// baocaixiong 下午4:33

namespace Mqs\Requests;


class ChangeMessageVisibility
{
    protected $payload = [
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
        $this->payload['ReceiptHandle'] = $handler;

        return $this;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setVisibilityTimeout($timeout)
    {
        $this->payload['VisibilityTimeout'] = $timeout;

        return $this;
    }
}