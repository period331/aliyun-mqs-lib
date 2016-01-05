<?php

namespace Mns\Requests;


class DeleteMessage extends BaseRequest
{
    protected $method = 'DELETE';

    protected $expectedStatus = 204;

    /**
     * @var array
     */
    protected $urlParams = [
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
        $this->urlParams['ReceiptHandle'] = $handler;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptHandler()
    {
        return $this->urlParams['ReceiptHandle'];
    }
}