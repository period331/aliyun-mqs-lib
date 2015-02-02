<?php

namespace Mqs\Requests;


class DeleteMessage extends BaseRequest
{
    protected $method = 'DELETE';

    /**
     * @var array
     */
    protected $payload = [
        'ReceiptHandle' => ''
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
}